<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GeminiService
{
    /**
     * =========================
     * Konfigurasi Utama
     * =========================
     */
    protected string $apiKey;
    protected string $baseUrl;
    protected string $model;

    public function __construct()
    {
        $this->apiKey = config('services.gemini.api_key');
        $this->baseUrl = "https://generativelanguage.googleapis.com/v1beta/models/";
        $this->model = "gemini-2.5-flash";
    }

    /**
     * =========================
     * CORE REQUEST (HTTP)
     * =========================
     */

    protected function request(array $payload): array
    {
        $response = Http::timeout(120)
            ->retry(3, 2000)
            ->post(
                $this->baseUrl . $this->model . ":generateContent?key=" . $this->apiKey,
                $payload
            );

        if (!$response->successful()) {
            throw new \Exception("Gemini API Error: " . $response->body());
        }

        return $response->json();
    }

    protected function extractText(array $response): ?string
    {
        $parts = $response['candidates'][0]['content']['parts'] ?? [];

        if (empty($parts)) {
            return null;
        }

        $fullText = '';

        foreach ($parts as $part) {
            if (isset($part['text'])) {
                $fullText .= $part['text'];
            }
        }

        if (preg_match('/\{.*\}/s', $fullText, $matches)) {
            return $matches[0];
        }

        return null;
    }

    protected function generateJson(string $prompt, array $schema = []): ?array
    {
        $payload = [
            "contents" => [
                [
                    "parts" => [
                        ["text" => $prompt]
                    ]
                ]
            ],

            "generationConfig" => [
                "temperature" => 1.0,
                "topK" => 64,
                "topP" => 0.95,
                "maxOutputTokens" => 65536,
                "responseMimeType" => "application/json",
                "thinkingConfig" => [
                    "includeThoughts" => true,
                    "thinkingBudget" => 15000
                ]
            ]
        ];

        if (!empty($schema)) {
            $payload["generationConfig"]["responseJsonSchema"] = $schema;
        }

        $response = $this->request($payload);
        Log::info("FULL GEMINI RESPONSE", $response);
        $text = $this->extractText($response);

        return json_decode($text, true);
    }

    /*
    ==================
    Core Switch
    ==================
    */

    public function generate(array $data, string $core): array
    {
        try {
            return match ($core) {
                'deep_learning' => $this->generateDeepLearning($data),
                'merdeka' => $this->generateMerdeka($data),
                default => throw new \Exception("Core tidak dikenali")
            };
        } catch (\Throwable $e) {
            return [
                'error' => true,
                'message' => $e->getMessage()
            ];
        }
    }


    protected function generateMerdeka(array $data): array
    {
        $prompt = $this->buildPromptMerdeka($data);

        return $this->generateJson(
            $prompt,
            $this->getSchemaMerdeka()
        );
    }

    protected function buildPromptMerdeka(array $data): string
    {
        $jsonData = json_encode($data, JSON_PRETTY_PRINT);

            return <<<EOT
        Anda adalah ahli pendidikan, kurikulum merdeka, dan instructional designer profesional.

        Anda memiliki kemampuan:
        - menyusun modul ajar Kurikulum Merdeka berbasis industri
        - merancang pembelajaran yang runtut, terarah, dan mendalam
        - mengintegrasikan meaningful, mindful, joyful learning
        - menyusun aktivitas guru & peserta didik secara sinkron dan operasional

        ==================================================
        DATA INPUT:
        {$jsonData}
        ==================================================

        TUGAS UTAMA:
        1. Analisis seluruh data secara menyeluruh
        2. Tentukan TUJUAN PEMBELAJARAN (tidak per pertemuan, tapi untuk keseluruhan pembelajaran)

        ATURAN TUJUAN:
        - Jika Fase E → level kognitif C3-C4
        - Jika Fase F → level kognitif C4-C6
        - Harus mencakup pengetahuan & keterampilan
        - Harus relevan dengan elemen, capaian, model, lingkungan, dan industri
        - Tambahkan tanda di setiap akhir kalimat untuk menandakan tingkat kognitif tujuan pembelajaran

        --------------------------------------------------

        3. Tentukan KOMPETENSI AWAL
        - Kemampuan dasar yang harus dimiliki peserta didik sebelum belajar

        --------------------------------------------------

        4. PEMAHAMAN BERMAKNA (1 PARAGRAF):
        WAJIB memenuhi:
        - bukan fakta terpisah
        - bersifat jangka panjang (enduring understanding)
        - aplikatif dalam kehidupan nyata

        --------------------------------------------------

        5. PERTANYAAN PEMANTIK:
        - memicu rasa ingin tahu
        - kontekstual & relevan dengan kehidupan nyata
        - minimal 3 pertanyaan

        --------------------------------------------------
        Pada Bagian Sarana dan Prasarana Pisahkan antar kategori dan bagi sarana menjadi media dan bahan
        sedangakan pada bagian sarana menjadi Sumber bahan pembelajaran
        SESUAIKAN DENGAN DATA INPUT
        --------------------------------------------------

        6. KEGIATAN PEMBELAJARAN:
        TERDIRI DARI:
        - kegiatan_pembuka
        - kegiatan_inti
        - kegiatan_penutup

        ATURAN PENULISAN:
        ❗ WAJIB bullet point (dalam string)
        ❗ setiap poin diawali "•"
        ❗ TIDAK BOLEH paragraf panjang

        ❗ WAJIB menggunakan kalimat operasional seperti modul ajar:
        - Guru: "Guru melakukan...", "Guru menginstruksikan...", "Guru membimbing..."
        - Siswa: "Peserta didik menjawab...", "Peserta didik berdiskusi...", "Peserta didik mengerjakan..."

        --------------------------------------------------

        KONTEN KEGIATAN:

        ### KEGIATAN PEMBUKA
        - Apersepsi
        - Motivasi
        - Penyampaian tujuan
        - Kaitan dengan kehidupan nyata

        ### KEGIATAN INTI
        - Harus mengikuti sintaks model pembelajaran (misalnya PBL, Discovery Learning, dll)
        - Harus mencerminkan:
        Pembelajaran bermakna dan berpusat pada siswa
        - Harus ada:
        - eksplorasi konsep
        - praktik / problem solving
        - kolaborasi
        - refleksi

        ### KEGIATAN PENUTUP
        - refleksi
        - evaluasi
        - tindak lanjut

        --------------------------------------------------

        7. ASESMEN:

        ### A. ASESMEN SIKAP
        - berdasarkan Profil Pelajar Pancasila
        - setiap dimensi memiliki:
        - 5 deskriptor (dari terbaik → terendah)
        Deskriptor harus disusun secara bertingkat (level 1-5) dengan pola kalimat yang konsisten dan progresif.

        Ketentuan penyusunan:
        Contohnya:
        - Gunakan struktur kalimat yang sama di setiap level
        - Perbedaan hanya pada tingkat kemampuan (dari paling rendah ke paling tinggi)
        - Gunakan kata kunci berikut secara konsisten:
        - "tidak secara sukarela" → "secara sukarela"
        - "tidak saling peduli" → "saling peduli"
        - "tidak bisa berbagi" → "bisa berbagi"

        Pola kalimat:
        "Peserta didik [tingkat kesukarelaan] dalam berkolaborasi, [tingkat kepedulian] dan [kemampuan berbagi] dalam menyelesaikan tugas kelompoknya."

        Urutan level:
        1. Semua aspek negatif
        2. Mulai ada positif, tapi aspek lain masih negatif
        3. Aspek Normal/Netral
        4. Ada beberapa aspek positif, dan beberapa netral
        5. Semua aspek positif

        Pastikan:
        - Kalimat tidak berubah struktur, hanya bagian tingkat kemampuan yang meningkat
        - Gunakan bahasa yang konsisten dan paralel antar level
        - Sesuai dengan kategori prediktor

        ### B. ASESMEN PENGETAHUAN
        - bentuk pilihan ganda
        - setiap soal:
        - 5 opsi
        - jawaban berupa angka index
        - level kognitif (C1-C6)
        - soal harus sesuai tujuan pembelajaran
        - harus sesuai dengan jumlah soal yang dikirim

        --------------------------------------------------

        8. PENGAYAAN DAN REMEDIAL:

        ### PENGAYAAN
        - diberikan kepada peserta didik dengan kemampuan tinggi
        - berisi kegiatan lanjutan yang lebih kompleks, eksploratif, atau berbasis proyek kecil
        - ditulis dalam 1 paragraf singkat

        ### REMEDIAL
        - diberikan kepada peserta didik dengan kemampuan rendah
        - berisi penguatan konsep dasar, bimbingan ulang, atau latihan sederhana
        - ditulis dalam 1 paragraf singkat

        --------------------------------------------------

        FORMAT OUTPUT (WAJIB JSON SAJA):

        {
        "tujuan_pembelajaran": ["..."],
        "kompetensi_awal": ["..."],
        "pemahaman_bermakna": "...",
        "pertanyaan_pemantik": ["..."],
        "sarana_prasarana":{
            "sarana": {
                "bahan": ["string"],
                "media": ["string"]
            },
            "prasarana": {
                sumber_belajar: ["string"],
            }
        },
        "kegiatan_pembelajaran": [
            {
                "nomor": 1,
                "kegiatan_pembuka": {
                    "alokasi_waktu": "string",
                    "guru": "• ...",
                    "siswa": "• ..."
                },
                "kegiatan_inti": {
                    "alokasi_waktu": "string",
                    "guru": "• ...",
                    "siswa": "• ..."
                },
                "kegiatan_penutup": {
                    "alokasi_waktu": "string",
                    "guru": "• ...",
                    "siswa": "• ..."
                },
            }
        ]
        "asesmen": {
            "sikap": [
            {
                "dimensi": "string",
                "deskriptor": ["...", "...", "...", "...", "..."]
            }
            ],
            "pengetahuan": {
            "jumlah_soal": 0,
            "soal": [
                {
                "nomor": 1,
                "pertanyaan": "string",
                "opsi": ["A", "B", "C", "D", "E"],
                "jawaban": 1,
                "level_kognitif": "C1"
                }
            ]
            }
        },
        "pengayaan": "string",
        "remedial": "string"
        }

        ==================================================
        ATURAN OUTPUT:
        - WAJIB hanya JSON
        - TANPA markdown
        - TANPA penjelasan
        - HARUS valid JSON
        ==================================================
        EOT;
    }

    protected function getSchemaMerdeka(): array
    {
        return [
            "type" => "object",
            "properties" => [

                "tujuan_pembelajaran" => [
                    "type" => "array",
                    "items" => ["type" => "string"]
                ],

                "kompetensi_awal" => [
                    "type" => "array",
                    "items" => ["type" => "string"]
                ],

                "pemahaman_bermakna" => [
                    "type" => "string"
                ],

                "pertanyaan_pemantik" => [
                    "type" => "array",
                    "items" => ["type" => "string"]
                ],

                "sarana_prasarana" => [
                            "type" => "object",
                            "properties" => [
                                "sarana" => [
                                    "type" => "object",
                                    "properties" => [
                                        "bahan" => [
                                            "type" => "array",
                                            "items" => ["type" => "string"]
                                        ],
                                        "media" => [
                                            "type" => "array",
                                            "items" => ["type" => "string"]
                                        ]
                                    ]
                                ],
                                "prasarana" => [
                                    "type" => "object",
                                    "properties" => [
                                        "sumber_belajar" => [
                                            "type" => "array",
                                            "items" => ["type" => "string"]
                                        ]
                                    ]
                                ]
                            ]
                ],

                "kegiatan_pembelajaran" => [
                    "type" => "object",
                    "additionalProperties" => [
                        "type" => "object",
                        "properties" => [
                            "kegiatan_pembuka" => [
                                "type" => "object",
                                "properties" => [
                                    "alokasi_waktu" => ["type" => "string"],
                                    "guru" => ["type" => "string"],
                                    "siswa" => ["type" => "string"]
                                ]
                            ],
                            "kegiatan_inti" => [
                                "type" => "object",
                                "properties" => [
                                    "alokasi_waktu" => ["type" => "string"],
                                    "guru" => ["type" => "string"],
                                    "siswa" => ["type" => "string"]
                                ]
                            ],
                            "kegiatan_penutup" => [
                                "type" => "object",
                                "properties" => [
                                    "alokasi_waktu" => ["type" => "string"],
                                    "guru" => ["type" => "string"],
                                    "siswa" => ["type" => "string"]
                                ]
                            ],


                        ],
                    ],
                ],

                "asesmen" => [
                    "type" => "object",
                    "properties" => [

                        "sikap" => [
                            "type" => "array",
                            "items" => [
                                "type" => "object",
                                "properties" => [
                                    "dimensi" => ["type" => "string"],
                                    "deskriptor" => [
                                        "type" => "array",
                                        "items" => ["type" => "string"]
                                    ]
                                ]
                            ]
                        ],

                        "pengetahuan" => [
                            "type" => "object",
                            "properties" => [
                                "jumlah_soal" => ["type" => "integer"],
                                "soal" => [
                                    "type" => "array",
                                    "items" => [
                                        "type" => "object",
                                        "properties" => [
                                            "nomor" => ["type" => "integer"],
                                            "pertanyaan" => ["type" => "string"],
                                            "opsi" => [
                                                "type" => "array",
                                                "items" => ["type" => "string"]
                                            ],
                                            "jawaban" => ["type" => "integer"],
                                            "level_kognitif" => ["type" => "string"]
                                        ]
                                    ]
                                ]
                            ]
                        ]
                    ]
                ],

                "pengayaan" => ["type" => "string"],
                "remedial" => ["type" => "string"],
            ]
        ];

    }


    protected function generateDeepLearning(array $data): array
    {
        $prompt = $this->buildPromptDeepLearning($data);

        return $this->generateJson(
            $prompt,
            $this->getSchemaDeepLearning()
        );
    }

    protected function buildPromptDeepLearning(array $data): string
    {
        $json = json_encode($data, JSON_PRETTY_PRINT);

        return <<<EOT
        Anda adalah ahli pendidikan, kurikulum, dan instructional designer profesional.

        Anda memiliki kemampuan:
        - menyusun modul ajar berbasis industri
        - merancang pembelajaran yang runtut, terarah, dan mendalam
        - mengintegrasikan meaningful, mindful, joyful learning
        - mengembangkan aktivitas guru & siswa secara sinkron

        ==================================================
        DATA INPUT:
        $json
        ==================================================

        TUGAS UTAMA:
        1. Analisis seluruh data secara menyeluruh dan mendalam
        2. Rumuskan tujuan pembelajaran terlebih dahulu
        - harus sinkron dengan: elemen, capaian, model, lingkungan, deskripsi industri
        - mencakup pengetahuan dan keterampilan
        - disusun per pertemuan secara runtut
        3. Setelah tujuan selesai → susun kegiatan pembelajaran

        ==================================================
        ATURAN KEGIATAN PEMBELAJARAN:
        Setiap pertemuan WAJIB memiliki:
        1. kegiatan_pembuka
        2. kegiatan_inti (dibagi menjadi 3 bagian):
        - memahami
        - mengaplikasikan
        - merefleksi
        3. kegiatan_penutup

        --------------------------------------------------
        FORMAT PENULISAN KEGIATAN (WAJIB IKUTI):
        ❗ JANGAN gunakan paragraf panjang
        ❗ WAJIB berbentuk poin-poin (bullet style dalam string)
        ❗ setiap poin diawali dengan simbol: "•"

        --------------------------------------------------
        KONTEN KEGIATAN HARUS:

        ### KEGIATAN PEMBUKA
        - Apersepsi, Motivasi, Penyampaian tujuan
        - Mengaitkan dengan kehidupan nyata
        - Membangun dimensi profil lulusan & mindful/meaningful learning

        ### KEGIATAN INTI
        #### 1. MEMAHAMI: eksplorasi konsep, observasi, stimulus, pertanyaan pemantik.
        #### 2. MENGAPLIKASIKAN: praktik langsung, problem solving industri, kolaborasi, diferensiasi.
        #### 3. MEREFLEKSI: analisis hasil, evaluasi proses, presentasi, umpan balik.

        ❗ setiap aktivitas HARUS detail, operasional, sinkron antara guru & siswa.

        ### KEGIATAN PENUTUP
        - refleksi, evaluasi, tindak lanjut, rangkuman bersama.

        ASSESSMENT:
        - bentuk pilihan ganda
        - setiap soal:
        - 5 opsi
        - jawaban berupa angka index
        - level kognitif (C1-C6)
        - soal harus sesuai tujuan pembelajaran
        - harus sesuai dengan jumlah soal yang dikirim

        ==================================================
        FORMAT OUTPUT (WAJIB HANYA JSON, TANPA MARKDOWN, TANPA PENJELASAN):

        {
            "pembelajaran": {
                "elemen": "string",
                "capaian": "string",
                "jumlah_pertemuan": 0,
                "tujuan_pembelajaran": [
                    {
                        "pertemuan": 1,
                        "tujuan": ["..."]
                    }
                ],
                "pertemuan": [
                    {
                        "nomor": 1,
                        "kegiatan_pembuka": {
                            "alokasi_waktu": "string",
                            "guru": "• ...",
                            "siswa": "• ..."
                        },
                        "kegiatan_inti": {
                            "memahami": { "alokasi_waktu": "string", "guru": "• ...", "siswa": "• ..." },
                            "mengaplikasikan": { "alokasi_waktu": "string", "guru": "• ...", "siswa": "• ..." },
                            "merefleksi": { "alokasi_waktu": "string", "guru": "• ...", "siswa": "• ..." }
                        },
                        "kegiatan_penutup": {
                            "alokasi_waktu": "string",
                            "guru": "• ...",
                            "siswa": "• ..."
                        }
                    }
                ]
            },
            "assessment_sumatif": {
                "jumlah_soal": 0,
                "soal": [
                    {
                        "nomor": 1,
                        "pertanyaan": "string",
                        "opsi": ["A", "B", "C", "D", "E"],
                        "jawaban": 1,
                        "level_kognitif": "C1"
                    }
                ]
            }
        }
        ==================================================
        ATURAN OUTPUT:
        - WAJIB hanya JSON
        - TANPA markdown
        - TANPA penjelasan tambahan
        - HARUS valid JSON
        EOT;
    }



    protected function getSchemaDeepLearning(): array
    {
        return [
            "type" => "object",
            "properties" => [

                "profil_lulusan" => [
                    "type" => "array",
                    "items" => ["type" => "string"]
                ],

                "pembelajaran" => [
                    "type" => "object",
                    "properties" => [

                        "elemen" => ["type" => "string"],
                        "capaian" => ["type" => "string"],
                        "jumlah_pertemuan" => ["type" => "integer"],
                        "dimensi_lulusan" => [
                            "type" => "array",
                            "items" => ["type" => "string"]
                        ],

                        "tujuan_pembelajaran" => [
                            "type" => "array",
                            "items" => [
                                "type" => "object",
                                "properties" => [
                                    "pertemuan" => ["type" => "integer"],
                                    "tujuan" => [
                                        "type" => "array",
                                        "items" => ["type" => "string"]
                                    ]
                                ]
                            ]
                        ],

                        "pertemuan" => [
                            "type" => "object",
                            "additionalProperties" => [
                                "type" => "object",
                                "properties" => [

                                    "kegiatan_pembuka" => [
                                        "type" => "object",
                                        "properties" => [
                                            "alokasi_waktu" => ["type" => "string"],
                                            "guru" => ["type" => "string"],
                                            "siswa" => ["type" => "string"]
                                        ]
                                    ],

                                    "kegiatan_inti" => [
                                        "type" => "object",
                                        "properties" => [

                                            "memahami" => [
                                                "type" => "object",
                                                "properties" => [
                                                    "alokasi_waktu" => ["type" => "string"],
                                                    "guru" => ["type" => "string"],
                                                    "siswa" => ["type" => "string"]
                                                ]
                                            ],

                                            "mengaplikasikan" => [
                                                "type" => "object",
                                                "properties" => [
                                                    "alokasi_waktu" => ["type" => "string"],
                                                    "guru" => ["type" => "string"],
                                                    "siswa" => ["type" => "string"]
                                                ]
                                            ],

                                            "merefleksi" => [
                                                "type" => "object",
                                                "properties" => [
                                                    "alokasi_waktu" => ["type" => "string"],
                                                    "guru" => ["type" => "string"],
                                                    "siswa" => ["type" => "string"]
                                                ]
                                            ]
                                        ]
                                    ],

                                    "kegiatan_penutup" => [
                                        "type" => "object",
                                        "properties" => [
                                            "alokasi_waktu" => ["type" => "string"],
                                            "guru" => ["type" => "string"],
                                            "siswa" => ["type" => "string"]
                                        ]
                                    ]
                                ]
                            ]
                        ]
                    ]
                ],

                "assessment_sumatif" => [
                    "type" => "object",
                    "properties" => [
                        "jumlah_soal" => ["type" => "integer"],
                        "soal" => [
                            "type" => "array",
                            "items" => [
                                "type" => "object",
                                "properties" => [
                                    "nomor" => ["type" => "integer"],
                                    "pertanyaan" => ["type" => "string"],
                                    "opsi" => [
                                        "type" => "array",
                                        "items" => ["type" => "string"]
                                    ],
                                    "jawaban" => ["type" => "integer"],
                                    "level_kognitif" => ["type" => "string"]
                                ]
                            ]
                        ]
                    ]
                ]
            ]
        ];

    }

}
