@extends('layouts.app')

@section('title', 'Pengaturan WhatsApp Gateway')

@push('styles')
<!-- Select2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
.select2-container--default .select2-selection--single {
    height: 42px;
    border: 1px solid #d1d5db;
    border-radius: 0.5rem;
    padding: 0 12px;
    display: flex;
    align-items: center;
}
.select2-container {
    width: 100% !important;
}
.select2-container--default .select2-selection--single .select2-selection__rendered {
    padding: 0;
    line-height: normal;
}
.select2-container--default .select2-selection--single .select2-selection__arrow {
    height: 40px;
    right: 12px;
}
.select2-dropdown {
    border-radius: 0.5rem;
    border: 1px solid #d1d5db;
}
.select2-container--default .select2-results__option--highlighted[aria-selected] {
    background-color: #3b82f6;
}
</style>
@endpush

@push('styles')
<!-- jQuery and Select2 Scripts in Head -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endpush

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center gap-4 mb-4">
                <div class="p-3 bg-green-100 rounded-xl">
                    <i class="fab fa-whatsapp text-2xl text-green-600"></i>
                </div>
                <div class="flex-1">
                    <h1 class="text-3xl font-bold text-gray-900">WhatsApp Gateway</h1>
                    <p class="text-gray-600 mt-1">Kelola sesi WhatsApp dan kirim pesan otomatis</p>
                </div>
                <div class="flex items-center gap-3">
                    <div id="gateway-status" class="flex items-center gap-2 px-3 py-2 rounded-lg">
                        <div id="status-indicator" class="w-3 h-3 rounded-full bg-gray-400"></div>
                        <span id="status-text" class="text-sm font-medium text-gray-600">Checking...</span>
                    </div>
                </div>
            </div>
            <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                <div class="flex items-start gap-3">
                    <i class="fas fa-info-circle text-blue-600 mt-0.5"></i>
                    <div class="text-sm text-blue-800">
                        <p class="font-medium mb-1">Menggunakan wa-gateway</p>
                        <p>Sistem ini terintegrasi dengan <a href="https://github.com/mimamch/wa-gateway" target="_blank" class="underline hover:text-blue-900">wa-gateway</a> untuk mengelola multi-sesi WhatsApp.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Gateway Instructions (Only shown when gateway is stopped) -->
        <div id="gatewayInstructions" class="hidden bg-yellow-50 border border-yellow-200 rounded-xl p-6 mb-8">
            <div class="flex items-start gap-4">
                <div class="p-3 bg-yellow-100 rounded-xl">
                    <i class="fas fa-exclamation-triangle text-2xl text-yellow-600"></i>
                </div>
                <div class="flex-1">
                    <h3 class="text-xl font-semibold text-yellow-800 mb-2">WhatsApp Gateway Tidak Berjalan</h3>
                    <p class="text-yellow-700 mb-4">Untuk menggunakan fitur WhatsApp Gateway, Anda perlu menjalankan wa-gateway terlebih dahulu.</p>

                    <div class="bg-white rounded-lg p-4 border border-yellow-200">
                        <h4 class="font-semibold text-gray-900 mb-3">Cara Menjalankan wa-gateway:</h4>
                        <ol class="list-decimal list-inside space-y-2 text-sm text-gray-700">
                            <li>Buka terminal/command prompt</li>
                            <li>Navigasi ke folder proyek: <code class="bg-gray-100 px-2 py-1 rounded text-xs">cd /path/to/amgpm</code></li>
                            <li>Masuk ke folder wa-gateway: <code class="bg-gray-100 px-2 py-1 rounded text-xs">cd wa-gateway</code></li>
                            <li>Install dependencies (jika belum): <code class="bg-gray-100 px-2 py-1 rounded text-xs">npm install</code></li>
                            <li>Jalankan gateway: <code class="bg-gray-100 px-2 py-1 rounded text-xs">npm run start</code></li>
                        </ol>

                        <div class="mt-4 p-3 bg-blue-50 border border-blue-200 rounded-lg">
                            <p class="text-sm text-blue-800">
                                <i class="fas fa-info-circle mr-1"></i>
                                <strong>Catatan:</strong> Gateway akan berjalan di <code class="bg-blue-100 px-1 rounded">http://localhost:5001</code>
                            </p>
                        </div>
                    </div>

                    <button onclick="window.location.href='{{ route('pengaturan.whatsapp.index') }}'" class="cursor-pointer mt-4 px-4 py-2 bg-yellow-600 text-white rounded-lg hover:bg-yellow-700 transition-colors duration-200">
                        <i class="fas fa-sync-alt mr-2"></i>Periksa Status Lagi
                    </button>
                </div>
            </div>
        </div>

        <div id="mainContent" class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Session Management -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200">
                <div class="p-6 border-b border-gray-200">
                    <div class="flex items-center gap-3 mb-2">
                        <i class="fas fa-mobile-alt text-green-600"></i>
                        <h2 class="text-xl font-semibold text-gray-900">Manajemen Sesi</h2>
                    </div>
                    <p class="text-gray-600 text-sm">Kelola sesi WhatsApp untuk multi-device</p>
                </div>
                <div class="p-6">
                    <!-- AMGPM Session Management -->
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Sesi WhatsApp AMGPM</label>
                        <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                            <div>
                                <h4 class="font-medium text-gray-900">amgpm</h4>
                                <p id="sessionStatus" class="text-sm text-gray-500">Memeriksa status...</p>
                            </div>
                            <div class="flex gap-2">
                                <button id="refreshStatusBtn" onclick="refreshMessages()"
                                        class="px-3 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500"
                                        title="Refresh Status">
                                    <i class="fas fa-sync-alt"></i>
                                </button>
                                <button id="sessionActionBtn" onclick="toggleSession()"
                                        class="px-4 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                        disabled>
                                    Memuat...
                                </button>
                            </div>
                        </div>
                    </div>



                    <!-- QR Code Display -->
                    <div id="qrCodeSection" class="hidden">
                        <div class="bg-gray-50 rounded-lg p-4 text-center">
                            <h3 class="font-medium text-gray-900 mb-2">Scan QR Code</h3>
                            <div id="qrCodeContainer" class="bg-white p-4 rounded-lg inline-block">
                                <!-- QR Code will be displayed here -->
                            </div>
                            <p class="text-sm text-gray-600 mt-2">Scan dengan WhatsApp di ponsel Anda</p>
                            <div class="mt-4">
                                <button id="confirmConnectionBtn" onclick="confirmConnection()"
                                        class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    Saya Sudah Terhubung
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Send Message (Only shown when connected) -->
            <div id="sendMessageSection" class="bg-white rounded-xl shadow-sm border border-gray-200 hidden">
                <div class="p-6 border-b border-gray-200">
                    <div class="flex items-center gap-3 mb-2">
                        <i class="fas fa-paper-plane text-blue-600"></i>
                        <h2 class="text-xl font-semibold text-gray-900">Kirim Pesan</h2>
                    </div>
                    <p class="text-gray-600 text-sm">Kirim pesan teks melalui WhatsApp</p>
                </div>
                <div class="p-6">
                    <form id="sendMessageForm" class="space-y-4">
                        <!-- Contact Selection -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Pilih Kontak</label>
                            <select id="contactSelect" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                <option value="">-- Pilih dari kontak atau masukkan manual --</option>
                            </select>
                        </div>

                        <!-- Phone Number -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Nomor Tujuan</label>
                            <input type="tel" id="phoneNumber" required
                                   placeholder="628123456789 (dengan kode negara)"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <p class="text-xs text-gray-500 mt-1">Format: 62 untuk Indonesia, tanpa tanda +</p>
                        </div>

                        <!-- Message Text -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Pesan</label>
                            <textarea id="messageText" required rows="4"
                                      placeholder="Tulis pesan Anda di sini..."
                                      class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 resize-none"></textarea>
                        </div>

                        <!-- Group Message Option -->
                        <div class="flex items-center gap-2">
                            <input type="checkbox" id="isGroup"
                                   class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                            <label for="isGroup" class="text-sm text-gray-700">Kirim ke grup (jika nomor tujuan adalah ID grup)</label>
                        </div>

                        <!-- Send Button -->
                        <button type="submit"
                                class="w-full px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200 font-medium cursor-pointer">
                            <i class="fas fa-paper-plane mr-2"></i>Kirim Pesan
                        </button>
                    </form>
                </div>
            </div>

            <!-- Send Image (Only shown when connected) -->
            <div id="sendImageSection" class="bg-white rounded-xl shadow-sm border border-gray-200 hidden">
                <div class="p-6 border-b border-gray-200">
                    <div class="flex items-center gap-3 mb-2">
                        <i class="fas fa-image text-green-600"></i>
                        <h2 class="text-xl font-semibold text-gray-900">Kirim Gambar</h2>
                    </div>
                    <p class="text-gray-600 text-sm">Kirim gambar dengan caption melalui WhatsApp</p>
                </div>
                <div class="p-6">
                    <form id="sendImageForm" class="space-y-4">
                        <!-- Contact Selection -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Pilih Kontak</label>
                            <select id="imageContactSelect" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500">
                                <option value="">-- Pilih dari kontak atau masukkan manual --</option>
                            </select>
                        </div>

                        <!-- Phone Number -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Nomor Tujuan</label>
                            <input type="tel" id="imagePhoneNumber" required
                                   placeholder="628123456789 (dengan kode negara)"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500">
                            <p class="text-xs text-gray-500 mt-1">Format: 62 untuk Indonesia, tanpa tanda +</p>
                        </div>

                        <!-- Image URL -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">URL Gambar</label>
                            <input type="url" id="imageUrl" required
                                   placeholder="https://example.com/image.jpg"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500">
                            <p class="text-xs text-gray-500 mt-1">URL gambar yang dapat diakses publik</p>
                        </div>

                        <!-- Caption Text -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Caption</label>
                            <textarea id="imageCaption" required rows="3"
                                      placeholder="Tulis caption untuk gambar..."
                                      class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 resize-none"></textarea>
                        </div>

                        <!-- Group Message Option -->
                        <div class="flex items-center gap-2">
                            <input type="checkbox" id="isImageGroup"
                                   class="w-4 h-4 text-green-600 border-gray-300 rounded focus:ring-green-500">
                            <label for="isImageGroup" class="text-sm text-gray-700">Kirim ke grup (jika nomor tujuan adalah ID grup)</label>
                        </div>

                        <!-- Send Button -->
                        <button type="submit"
                                class="w-full px-6 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors duration-200 font-medium cursor-pointer">
                            <i class="fas fa-image mr-2"></i>Kirim Gambar
                        </button>
                    </form>
                </div>
            </div>

            <!-- Send Document (Only shown when connected) -->
            <div id="sendDocumentSection" class="bg-white rounded-xl shadow-sm border border-gray-200 hidden">
                <div class="p-6 border-b border-gray-200">
                    <div class="flex items-center gap-3 mb-2">
                        <i class="fas fa-file-alt text-purple-600"></i>
                        <h2 class="text-xl font-semibold text-gray-900">Kirim Dokumen</h2>
                    </div>
                    <p class="text-gray-600 text-sm">Kirim dokumen dengan caption melalui WhatsApp</p>
                </div>
                <div class="p-6">
                    <form id="sendDocumentForm" class="space-y-4">
                        <!-- Contact Selection -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Pilih Kontak</label>
                            <select id="documentContactSelect" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                                <option value="">-- Pilih dari kontak atau masukkan manual --</option>
                            </select>
                        </div>

                        <!-- Phone Number -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Nomor Tujuan</label>
                            <input type="tel" id="documentPhoneNumber" required
                                   placeholder="628123456789 (dengan kode negara)"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                            <p class="text-xs text-gray-500 mt-1">Format: 62 untuk Indonesia, tanpa tanda +</p>
                        </div>

                        <!-- Document URL -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">URL Dokumen</label>
                            <input type="url" id="documentUrl" required
                                   placeholder="https://example.com/document.pdf"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                            <p class="text-xs text-gray-500 mt-1">URL dokumen yang dapat diakses publik</p>
                        </div>

                        <!-- Document Name -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Nama Dokumen</label>
                            <input type="text" id="documentName" required
                                   placeholder="document.pdf"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                            <p class="text-xs text-gray-500 mt-1">Nama file yang akan ditampilkan</p>
                        </div>

                        <!-- Caption Text -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Caption</label>
                            <textarea id="documentCaption" required rows="3"
                                      placeholder="Tulis caption untuk dokumen..."
                                      class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 resize-none"></textarea>
                        </div>

                        <!-- Group Message Option -->
                        <div class="flex items-center gap-2">
                            <input type="checkbox" id="isDocumentGroup"
                                   class="w-4 h-4 text-purple-600 border-gray-300 rounded focus:ring-purple-500">
                            <label for="isDocumentGroup" class="text-sm text-gray-700">Kirim ke grup (jika nomor tujuan adalah ID grup)</label>
                        </div>

                        <!-- Send Button -->
                        <button type="submit"
                                class="w-full px-6 py-3 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition-colors duration-200 font-medium cursor-pointer">
                            <i class="fas fa-file-alt mr-2"></i>Kirim Dokumen
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Message History (Only shown when connected) -->
        <div id="messageHistorySection" class="mt-8 bg-white rounded-xl shadow-sm border border-gray-200 hidden">
            <div class="p-6 border-b border-gray-200">
                <div class="flex items-center gap-3 mb-2">
                    <i class="fas fa-history text-purple-600"></i>
                    <h2 class="text-xl font-semibold text-gray-900">Riwayat Pesan</h2>
                </div>
                <p class="text-gray-600 text-sm">Log pesan yang telah dikirim</p>
            </div>
            <div class="p-6">
                <div id="messageHistory" class="space-y-3">
                    <div class="text-center py-8 text-gray-500">
                        <i class="fas fa-inbox text-3xl mb-2 opacity-50"></i>
                        <p>Belum ada riwayat pesan</p>
                        <p class="text-sm">Pesan yang dikirim akan muncul di sini</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript -->
<script>
    // Base URL for wa-gateway API - ambil dari config
    const WA_GATEWAY_URL = '{{ config("wa_gateway_url", "http://localhost:5001") }}';

    // Check AMGPM session status
    async function checkAMGPMSessionStatus() {
        try {
            // Check if amgpm session exists in session list
            const sessionsResponse = await fetch(`${WA_GATEWAY_URL}/session`, {
                method: 'GET'
            });

            if (sessionsResponse.ok) {
                const result = await sessionsResponse.json();
                const sessions = result.data || [];

                if (sessions.includes('amgpm')) {
                    // Session already exists and is connected
                    updateSessionUI(true);
                    return;
                }

                // If session doesn't exist in list, session is not connected
                updateSessionUI(false);
            } else {
                updateSessionUI(false, 'Gagal memeriksa status');
            }
        } catch (error) {
            console.error('Error:', error);
            updateSessionUI(false, 'Tidak dapat terhubung ke wa-gateway');
        }
    }

    // Update session UI based on status
    function updateSessionUI(isConnected, errorMessage = null) {
        const statusEl = document.getElementById('sessionStatus');
        const btnEl = document.getElementById('sessionActionBtn');
        const sendMessageSection = document.getElementById('sendMessageSection');
        const messageHistorySection = document.getElementById('messageHistorySection');

        if (errorMessage) {
            statusEl.textContent = errorMessage;
            statusEl.className = 'text-sm text-red-500';
            btnEl.textContent = 'Coba Lagi';
            btnEl.className = 'px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500';
            btnEl.disabled = false;
            btnEl.onclick = checkAMGPMSessionStatus;
            // Hide message sections
            sendMessageSection.classList.add('hidden');
            document.getElementById('sendImageSection').classList.add('hidden');
            document.getElementById('sendDocumentSection').classList.add('hidden');
            messageHistorySection.classList.add('hidden');
        } else if (isConnected) {
            statusEl.textContent = 'Terhubung';
            statusEl.className = 'text-sm text-green-600';
            btnEl.textContent = 'Putuskan';
            btnEl.className = 'px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500';
            btnEl.disabled = false;
            btnEl.onclick = () => toggleSession(false);
            // Show message sections
            sendMessageSection.classList.remove('hidden');
            document.getElementById('sendImageSection').classList.remove('hidden');
            document.getElementById('sendDocumentSection').classList.remove('hidden');
            messageHistorySection.classList.remove('hidden');
            // Note: refreshMessages() removed - use manual refresh button instead
        } else {
            statusEl.textContent = 'Tidak terhubung';
            statusEl.className = 'text-sm text-gray-500';
            btnEl.textContent = 'Hubungkan';
            btnEl.className = 'px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500';
            btnEl.disabled = false;
            btnEl.onclick = () => toggleSession(true);
            // Hide message sections
            sendMessageSection.classList.add('hidden');
            messageHistorySection.classList.add('hidden');
        }
    }

    // Toggle session connection
    async function toggleSession(connect = null) {
        const btnEl = document.getElementById('sessionActionBtn');
        const statusEl = document.getElementById('sessionStatus');

        // Determine action if not specified
        if (connect === null) {
            const isCurrentlyConnected = statusEl.textContent === 'Terhubung';
            connect = !isCurrentlyConnected;
        }

        btnEl.disabled = true;
        btnEl.textContent = connect ? 'Menghubungkan...' : 'Memutuskan...';
        statusEl.textContent = connect ? 'Menghubungkan...' : 'Memutuskan...';

        try {
            if (connect) {
                // Start session
                const response = await fetch(`${WA_GATEWAY_URL}/session/start?session=amgpm`, {
                    method: 'GET'
                });

                if (response.ok) {
                    const responseText = await response.text();

                    try {
                        const result = JSON.parse(responseText);
                        if (result.message === "Session already exist") {
                            // Session already exists but may not be connected
                            updateSessionUI(false);
                            return;
                        }
                    } catch (e) {
                        // Response is not JSON, it's HTML with QR code
                    }

                    // New session, show QR code
                     showQRCode(responseText);
                     // Don't auto-check status, wait for user confirmation
                } else {
                    updateSessionUI(false, 'Gagal memulai sesi');
                }
            } else {
                // Delete session
                 const response = await fetch(`${WA_GATEWAY_URL}/session/logout?session=amgpm`, {
                     method: 'GET'
                 });

                if (response.ok) {
                    hideQRCode();
                    updateSessionUI(false);
                } else {
                    updateSessionUI(true, 'Gagal memutuskan sesi');
                }
            }
        } catch (error) {
            console.error('Error:', error);
            updateSessionUI(false, 'Gagal terhubung ke wa-gateway');
        }
    }

    // Confirm connection after QR scan
    function confirmConnection() {
        hideQRCode();
        checkAMGPMSessionStatus();
    }

    // Show QR Code
    function showQRCode(htmlResponse) {
        const qrSection = document.getElementById('qrCodeSection');
        const qrContainer = document.getElementById('qrCodeContainer');

        qrSection.classList.remove('hidden');

        // Extract QR code base64 from HTML response
        let qrCodeBase64 = '';
        const scriptMatch = htmlResponse.match(/let qr = '([^']+)'/);
        if (scriptMatch && scriptMatch[1]) {
            qrCodeBase64 = scriptMatch[1];
        }

        if (qrCodeBase64) {
            qrContainer.innerHTML = `
                <p class="text-sm font-medium text-gray-900 mb-3">Sesi: amgpm</p>
                <div class="bg-white p-4 rounded-lg border-2 border-gray-200 inline-block">
                    <img src="${qrCodeBase64}" alt="QR Code" class="w-48 h-48 mx-auto" />
                </div>
                <p class="text-xs text-gray-500 mt-3">Scan QR code dengan WhatsApp di ponsel Anda</p>
                <p class="text-xs text-gray-400 mt-1">QR code akan expired dalam beberapa menit</p>
             `;
         } else {
             qrContainer.innerHTML = `
                 <p class="text-sm text-gray-600 mb-2">Sesi: amgpm</p>
                 <p class="text-xs text-gray-500">QR Code tidak ditemukan. Buka browser dan akses:</p>
                 <code class="text-xs bg-gray-100 px-2 py-1 rounded">${WA_GATEWAY_URL}/session/start?session=amgpm</code>
             `;
         }
     }

     // Hide QR Code
     function hideQRCode() {
         const qrSection = document.getElementById('qrCodeSection');
         qrSection.classList.add('hidden');
    }



    // Refresh message history
    async function refreshMessages() {
        const refreshBtn = document.getElementById('refreshStatusBtn');
        const refreshIcon = refreshBtn.querySelector('i');

        // Add loading state
        refreshBtn.disabled = true;
        refreshIcon.classList.add('fa-spin');

        try {
            const response = await fetch(`${WA_GATEWAY_URL}/session`, {
                method: 'GET'
            });

            if (response.ok) {
                const result = await response.json();
                const sessions = result.data || [];

                // Check if amgpm session is in the active sessions list
                if (sessions.includes('amgpm')) {
                    // Session is connected
                    updateSessionUI(true);
                } else {
                    // Session is not connected
                    updateSessionUI(false);
                }
            }
        } catch (error) {
            console.error('Error refreshing messages:', error);
            updateSessionUI(false, 'Gagal memeriksa status');
        } finally {
            // Remove loading state
            refreshBtn.disabled = false;
            refreshIcon.classList.remove('fa-spin');
        }
    }



    // Update message history display
    function updateMessageHistory(messages) {
        const historyContainer = document.getElementById('messageHistory');

        if (!messages || messages.length === 0) {
            historyContainer.innerHTML = '<p class="text-gray-500 text-center py-8">Belum ada riwayat pesan</p>';
            return;
        }

        const messageHTML = messages.slice(-10).reverse().map(msg => `
            <div class="p-3 bg-gray-50 rounded-lg">
                <div class="flex justify-between items-start mb-1">
                    <span class="text-sm font-medium text-gray-900">${msg.to || 'Unknown'}</span>
                    <span class="text-xs text-gray-500">${new Date(msg.timestamp).toLocaleString()}</span>
                </div>
                <p class="text-sm text-gray-700">${msg.text || msg.message || 'No message'}</p>
            </div>
        `).join('');

        historyContainer.innerHTML = messageHTML;
    }

    // Delete session - GET /session/logout?session=SESSION_NAME
    async function deleteSession(sessionName) {
        if (!confirm(`Hapus sesi '${sessionName}'?`)) return;

        try {
            const response = await fetch(`${WA_GATEWAY_URL}/session/logout?session=${sessionName}`, {
                method: 'GET'
            });
            if (response.ok) {
                alert(`Sesi '${sessionName}' berhasil dihapus!`);
                refreshSessions();
            } else {
                alert('Gagal menghapus sesi. Periksa koneksi wa-gateway.');
            }
        } catch (error) {
            console.error('Error:', error);
            alert('Gagal menghapus sesi.');
        }
    }

    // Send message using amgpm session
    async function sendMessage() {
        const phoneNumber = document.getElementById('phoneNumber').value.trim();
        const messageText = document.getElementById('messageText').value.trim();
        const isGroup = document.getElementById('isGroup').checked;
        const submitBtn = document.querySelector('#sendMessageForm button[type="submit"]');

        if (!phoneNumber || !messageText) {
            alert('Masukkan nomor tujuan dan pesan!');
            return;
        }

        // Set loading state
        const originalText = submitBtn.innerHTML;
        submitBtn.disabled = true;
        submitBtn.style.cursor = 'not-allowed';
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Mengirim...';

        try {
            const response = await fetch(`${WA_GATEWAY_URL}/message/send-text`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    session: 'amgpm',
                    to: phoneNumber,
                    text: messageText,
                    is_group: isGroup
                })
            });

            if (response.ok) {
                alert('Pesan berhasil dikirim!');
                document.getElementById('phoneNumber').value = '';
                document.getElementById('messageText').value = '';
                document.getElementById('isGroup').checked = false;
                addToMessageHistory('amgpm', phoneNumber, messageText, isGroup);
                refreshMessages();
            } else {
                alert('Gagal mengirim pesan. Pastikan nomor tujuan benar.');
            }
        } catch (error) {
            console.error('Error:', error);
            alert('Gagal terhubung ke wa-gateway.');
        } finally {
            // Reset button state
            submitBtn.disabled = false;
            submitBtn.style.cursor = 'pointer';
            submitBtn.innerHTML = originalText;
        }
    }

    // Send image using amgpm session
    async function sendImage() {
        const phoneNumber = document.getElementById('imagePhoneNumber').value.trim();
        const imageUrl = document.getElementById('imageUrl').value.trim();
        const caption = document.getElementById('imageCaption').value.trim();
        const isGroup = document.getElementById('isImageGroup').checked;
        const submitBtn = document.querySelector('#sendImageForm button[type="submit"]');

        if (!phoneNumber || !imageUrl || !caption) {
            alert('Masukkan nomor tujuan, URL gambar, dan caption!');
            return;
        }

        // Set loading state
        const originalText = submitBtn.innerHTML;
        submitBtn.disabled = true;
        submitBtn.style.cursor = 'not-allowed';
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Mengirim...';

        try {
            const response = await fetch(`${WA_GATEWAY_URL}/message/send-image`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    session: 'amgpm',
                    to: phoneNumber,
                    text: caption,
                    image_url: imageUrl,
                    is_group: isGroup
                })
            });

            if (response.ok) {
                alert('Gambar berhasil dikirim!');
                document.getElementById('imagePhoneNumber').value = '';
                document.getElementById('imageUrl').value = '';
                document.getElementById('imageCaption').value = '';
                document.getElementById('isImageGroup').checked = false;
                addToMessageHistory('amgpm', phoneNumber, `[Gambar] ${caption}`, isGroup);
                refreshMessages();
            } else {
                alert('Gagal mengirim gambar. Pastikan URL gambar valid dan nomor tujuan benar.');
            }
        } catch (error) {
            console.error('Error:', error);
            alert('Gagal terhubung ke wa-gateway.');
        } finally {
            // Reset button state
            submitBtn.disabled = false;
            submitBtn.style.cursor = 'pointer';
            submitBtn.innerHTML = originalText;
        }
    }

    // Send document using amgpm session
    async function sendDocument() {
        const phoneNumber = document.getElementById('documentPhoneNumber').value.trim();
        const documentUrl = document.getElementById('documentUrl').value.trim();
        const documentName = document.getElementById('documentName').value.trim();
        const caption = document.getElementById('documentCaption').value.trim();
        const isGroup = document.getElementById('isDocumentGroup').checked;
        const submitBtn = document.querySelector('#sendDocumentForm button[type="submit"]');

        if (!phoneNumber || !documentUrl || !documentName || !caption) {
            alert('Masukkan semua field yang diperlukan!');
            return;
        }

        // Set loading state
        const originalText = submitBtn.innerHTML;
        submitBtn.disabled = true;
        submitBtn.style.cursor = 'not-allowed';
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Mengirim...';

        try {
            const response = await fetch(`${WA_GATEWAY_URL}/message/send-document`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    session: 'amgpm',
                    to: phoneNumber,
                    text: caption,
                    document_url: documentUrl,
                    document_name: documentName,
                    is_group: isGroup
                })
            });

            if (response.ok) {
                alert('Dokumen berhasil dikirim!');
                document.getElementById('documentPhoneNumber').value = '';
                document.getElementById('documentUrl').value = '';
                document.getElementById('documentName').value = '';
                document.getElementById('documentCaption').value = '';
                document.getElementById('isDocumentGroup').checked = false;
                addToMessageHistory('amgpm', phoneNumber, `[Dokumen: ${documentName}] ${caption}`, isGroup);
                refreshMessages();
            } else {
                alert('Gagal mengirim dokumen. Pastikan URL dokumen valid dan nomor tujuan benar.');
            }
        } catch (error) {
            console.error('Error:', error);
            alert('Gagal terhubung ke wa-gateway.');
        } finally {
            // Reset button state
            submitBtn.disabled = false;
            submitBtn.style.cursor = 'pointer';
            submitBtn.innerHTML = originalText;
        }
    }

    // Send message
    document.getElementById('sendMessageForm').addEventListener('submit', async function(e) {
        e.preventDefault();
        await sendMessage();
    });

    // Send image
    document.getElementById('sendImageForm').addEventListener('submit', async function(e) {
        e.preventDefault();
        await sendImage();
    });

    // Send document
    document.getElementById('sendDocumentForm').addEventListener('submit', async function(e) {
        e.preventDefault();
        await sendDocument();
    });

    // Add to message history
    function addToMessageHistory(session, to, text, isGroup) {
        const container = document.getElementById('messageHistory');
        const timestamp = new Date().toLocaleString('id-ID');

        // Remove empty state if exists
        if (container.querySelector('.text-center')) {
            container.innerHTML = '';
        }

        const messageItem = document.createElement('div');
        messageItem.className = 'p-4 bg-gray-50 rounded-lg border-l-4 border-green-500';
        messageItem.innerHTML = `
            <div class="flex items-start justify-between">
                <div class="flex-1">
                    <div class="flex items-center gap-2 mb-1">
                        <span class="text-sm font-medium text-gray-900">Sesi: ${session}</span>
                        <span class="text-xs text-gray-500">•</span>
                        <span class="text-sm text-gray-600">Ke: ${to}</span>
                        ${isGroup ? '<span class="text-xs bg-blue-100 text-blue-800 px-2 py-1 rounded">Grup</span>' : ''}
                    </div>
                    <p class="text-gray-800 mb-2">${text}</p>
                    <p class="text-xs text-gray-500">${timestamp}</p>
                </div>
                <div class="text-green-600">
                    <i class="fas fa-check-circle"></i>
                </div>
            </div>
        `;

        container.insertBefore(messageItem, container.firstChild);
    }

    // Initialize Select2 for all contact dropdowns
    function initializeSelect2() {
        const selects = [
            { id: '#contactSelect', target: '#phoneNumber' },
            { id: '#imageContactSelect', target: '#imagePhoneNumber' },
            { id: '#documentContactSelect', target: '#documentPhoneNumber' }
        ];

        selects.forEach(function(selectConfig) {
            $(selectConfig.id).select2({
                placeholder: '-- Pilih dari kontak atau masukkan manual --',
                allowClear: true,
                ajax: {
                    url: '{{ route("pengaturan.whatsapp.contacts") }}',
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                        return {
                            q: params.term // search term
                        };
                    },
                    processResults: function (data) {
                        return {
                            results: data.results
                        };
                    },
                    cache: true
                },
                minimumInputLength: 0,
                templateResult: function(contact) {
                    if (contact.loading) {
                        return contact.text;
                    }
                    return contact.text;
                },
                templateSelection: function(contact) {
                    return contact.text || contact.id;
                }
            });

            // Handle selection
            $(selectConfig.id).on('select2:select', function (e) {
                const data = e.params.data;
                $(selectConfig.target).val(data.id);
            });

            // Handle clear
            $(selectConfig.id).on('select2:clear', function (e) {
                $(selectConfig.target).val('');
            });
        });
    }

    // Initialize on page load
    document.addEventListener('DOMContentLoaded', function() {
        checkAMGPMSessionStatus();

        // Wait for jQuery to be loaded
        if (typeof $ !== 'undefined') {
            initializeSelect2();
        } else {
            // Fallback if jQuery is not loaded yet
            setTimeout(function() {
                if (typeof $ !== 'undefined') {
                    initializeSelect2();
                }
            }, 100);
        }
    });

    // Check wa-gateway status
    async function checkGatewayStatus() {
        const statusIndicator = document.getElementById('status-indicator');
        const statusText = document.getElementById('status-text');
        const gatewayInstructions = document.getElementById('gatewayInstructions');
        const mainContent = document.getElementById('mainContent');

        try {
            const response = await fetch('{{config('app.wa_gateway_url')}}', {
                method: 'GET',
                mode: 'no-cors'
            });

            // If we reach here, the server is running
            statusIndicator.className = 'w-3 h-3 rounded-full bg-green-500';
            statusText.textContent = 'Gateway Running';
            statusText.className = 'text-sm font-medium text-green-600';

            // Show main content, hide instructions
            gatewayInstructions.classList.add('hidden');
            mainContent.classList.remove('hidden');
        } catch (error) {
            // Server is not running
            statusIndicator.className = 'w-3 h-3 rounded-full bg-red-500';
            statusText.textContent = 'Gateway Stopped';
            statusText.className = 'text-sm font-medium text-red-600';

            // Hide main content, show instructions
            mainContent.classList.add('hidden');
            gatewayInstructions.classList.remove('hidden');
        }
    }



    // Also initialize when jQuery is ready
    $(document).ready(function() {
        initializeSelect2();
        checkGatewayStatus();
    });

    // Check status periodically
    setInterval(checkGatewayStatus, 30000); // Check every 30 seconds
</script>

@endsection
