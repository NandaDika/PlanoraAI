<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-bold text-2xl text-gray-800">
                    Editor Dokumen
                </h2>
                <p class="text-sm text-gray-600 mt-1">
                    Edit data sebelum mengekspor ke PDF/Word
                    @if(isset($data['input_data']['identitas']['nama_penyusun']))
                        • {{ $data['input_data']['identitas']['nama_penyusun'] }}
                    @endif
                </p>
            </div>
            <div class="flex gap-3">
                <span class="inline-flex items-center px-3 py-1.5 rounded-lg text-sm font-medium
                    {{ isset($data['pembelajaran']['elemen']) && str_contains(strtolower($data['pembelajaran']['elemen']), 'web') ? 'bg-purple-100 text-purple-800' : 'bg-blue-100 text-blue-800' }}">
                    @if(isset($data['input_data']['identitas']['kompetensi_keahlian']))
                        Kurikulum Merdeka
                    @else
                        Deep Learning
                    @endif
                </span>
            </div>
        </div>
    </x-slot>

    <!-- Warning Modal -->
    <div id="save-modal" class="hidden fixed inset-0 z-50 overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity bg-gray-900 bg-opacity-75" id="modal-overlay"></div>

            <div class="inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white px-6 pt-6 pb-4">
                    <div class="flex items-start gap-4">
                        <div class="flex-shrink-0 w-12 h-12 rounded-full bg-yellow-100 flex items-center justify-center">
                            <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <h3 class="text-lg font-semibold text-gray-900">
                                Konfirmasi Penyimpanan
                            </h3>
                            <p class="text-sm text-gray-600 mt-2">
                                Data yang sudah ada akan ditimpa dengan data baru. Apakah Anda yakin ingin menyimpan perubahan?
                            </p>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-6 py-4 flex gap-3 justify-end">
                    <button onclick="closeModal()" type="button" class="px-6 py-2.5 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-100 transition font-medium">
                        Batal
                    </button>
                    <button onclick="confirmSave()" type="button" class="px-6 py-2.5 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition font-medium">
                        Ya, Simpan
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto">
        <form id="editor-form" method="POST" action="{{ route('dokumen.update', $data['hashid']) }}" class="space-y-6">
            @csrf
            @method('PUT')

            @if($data['core_type'] == 'merdeka')
                {{-- KURIKULUM MERDEKA --}}
                @include('components.editor.merdeka', ['data' => $data])
            @else
                {{-- DEEP LEARNING --}}
                @include('components.editor.deeplearning', ['data' => $data])
            @endif

            <!-- Action Buttons (Sticky Bottom) -->
            <div class="sticky bottom-0 left-0 right-0 bg-white border-t border-gray-200 shadow-lg z-10">
                <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
                    <a href="{{ route('antrian.list') }}" class="px-6 py-3 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition font-semibold flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Kembali
                    </a>
                    <div class="flex gap-3">
                        <button type="button" onclick="showSaveModal()" class="px-8 py-3 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition font-semibold flex items-center gap-2 shadow-lg">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path>
                            </svg>
                            Simpan Perubahan
                        </button>
                        <button type="button" class="px-6 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700 transition font-semibold flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            Export PDF
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script>
        function showSaveModal() {
            document.getElementById('save-modal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeModal() {
            document.getElementById('save-modal').classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        function confirmSave() {
            document.getElementById('editor-form').submit();
        }

        // Close modal on overlay click
        document.getElementById('modal-overlay')?.addEventListener('click', closeModal);

        // Close modal on ESC
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeModal();
            }
        });

        // Auto-resize textareas
        document.addEventListener('DOMContentLoaded', function() {
            const textareas = document.querySelectorAll('textarea');
            textareas.forEach(textarea => {
                textarea.addEventListener('input', function() {
                    this.style.height = 'auto';
                    this.style.height = (this.scrollHeight) + 'px';
                });
                // Trigger on load
                textarea.dispatchEvent(new Event('input'));
            });
        });
    </script>
</x-app-layout>
