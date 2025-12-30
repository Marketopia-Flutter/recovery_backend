<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>توصيل واتساب - {{ $customer->name }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @keyframes spin {
            from {
                transform: rotate(0deg);
            }

            to {
                transform: rotate(360deg);
            }
        }

        .spinner {
            animation: spin 1s linear infinite;
        }
    </style>
</head>

<body class="bg-gradient-to-br from-green-50 to-blue-50 min-h-screen flex items-center justify-center p-4">
    <div class="max-w-2xl w-full bg-white rounded-2xl shadow-2xl p-8">
        <!-- Header -->
        <div class="text-center mb-8">
            <div class="inline-block p-4 bg-green-100 rounded-full mb-4">
                <svg class="w-16 h-16 text-green-600" fill="currentColor" viewBox="0 0 24 24">
                    <path
                        d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z" />
                </svg>
            </div>
            <h1 class="text-3xl font-bold text-gray-800 mb-2">توصيل واتساب</h1>
            <p class="text-gray-600">{{ $customer->name }}</p>
        </div>

        <!-- Status Container -->
        <div id="statusContainer">
            <!-- Loading State -->
            <div id="loadingState" class="text-center">
                <div
                    class="spinner inline-block w-12 h-12 border-4 border-green-200 border-t-green-600 rounded-full mb-4">
                </div>
                <p id="loadingText" class="text-gray-600">جاري التحميل...</p>
            </div>

            <!-- QR Code State -->
            <div id="qrState" class="hidden">
                <div class="text-center mb-6">
                    <div class="inline-block p-4 bg-white border-4 border-green-500 rounded-xl mb-4">
                        <img id="qrImage" src="" alt="QR Code" class="w-64 h-64">
                    </div>
                </div>

                <div class="bg-blue-50 border-l-4 border-blue-500 p-4 rounded-lg mb-6">
                    <h3 class="font-bold text-blue-900 mb-2">📱 خطوات التوصيل:</h3>
                    <ol class="list-decimal list-inside text-blue-800 space-y-2">
                        <li>افتح تطبيق واتساب على هاتفك</li>
                        <li>اذهب إلى <strong>الإعدادات</strong> ← <strong>الأجهزة المرتبطة</strong></li>
                        <li>اضغط على <strong>ربط جهاز</strong></li>
                        <li>امسح الـ QR Code أعلاه</li>
                    </ol>
                </div>

                <div class="flex items-center justify-center space-x-2 space-x-reverse text-sm text-gray-500">
                    <div class="spinner inline-block w-4 h-4 border-2 border-gray-300 border-t-gray-600 rounded-full">
                    </div>
                    <span>جاري الانتظار للاتصال...</span>
                </div>
            </div>

            <!-- Connected State -->
            <div id="connectedState" class="hidden text-center">
                <div class="inline-block p-4 bg-green-100 rounded-full mb-4">
                    <svg class="w-16 h-16 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
                <h2 class="text-2xl font-bold text-green-600 mb-2">تم الاتصال بنجاح! ✅</h2>
                <p class="text-gray-600 mb-2">رقم الواتساب: <span id="phoneNumber" class="font-bold"></span></p>
                <p class="text-gray-600 mb-6">الاسم: <span id="accountName" class="font-bold"></span></p>

                <div class="bg-green-50 border border-green-200 rounded-lg p-4 mb-6">
                    <p class="text-green-800">✨ الآن يمكنك إرسال الرسائل من حسابك!</p>
                </div>

                <button onclick="window.close()"
                    class="bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-8 rounded-lg transition duration-200">
                    إغلاق النافذة
                </button>
            </div>

            <!-- Error State -->
            <div id="errorState" class="hidden text-center">
                <div class="inline-block p-4 bg-red-100 rounded-full mb-4">
                    <svg class="w-16 h-16 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </div>
                <h2 class="text-2xl font-bold text-red-600 mb-2">حدث خطأ</h2>
                <p id="errorMessage" class="text-gray-600 mb-6"></p>
                <button onclick="location.reload()"
                    class="bg-red-600 hover:bg-red-700 text-white font-bold py-3 px-8 rounded-lg transition duration-200">
                    إعادة المحاولة
                </button>
            </div>
        </div>
    </div>

    <script>
        const customerId = {{ $customer->id }};
        let checkInterval;

        // Hide all states
        function hideAllStates() {
            document.getElementById('loadingState').classList.add('hidden');
            document.getElementById('qrState').classList.add('hidden');
            document.getElementById('connectedState').classList.add('hidden');
            document.getElementById('errorState').classList.add('hidden');
        }

        // Show loading state
        function showLoading(text = 'جاري التحميل...') {
            hideAllStates();
            document.getElementById('loadingText').textContent = text;
            document.getElementById('loadingState').classList.remove('hidden');
        }

        // Show QR state
        function showQR(qrCode) {
            hideAllStates();
            document.getElementById('qrImage').src = qrCode;
            document.getElementById('qrState').classList.remove('hidden');
        }

        // Show connected state
        function showConnected(phoneNumber, name) {
            hideAllStates();
            document.getElementById('phoneNumber').textContent = phoneNumber || 'غير متوفر';
            document.getElementById('accountName').textContent = name || 'غير متوفر';
            document.getElementById('connectedState').classList.remove('hidden');

            // Stop checking
            if (checkInterval) {
                clearInterval(checkInterval);
            }

            // Play success sound (optional)
            try {
                new Audio('data:audio/wav;base64,UklGRnoGAABXQVZFZm10IBAAAAABAAEAQB8AAEAfAAABAAgAZGF0YQoGAACBhYqFbF1fdJivrJBhNjVgodDbq2EcBj+a2/LDciUFLIHO8tiJNwgZaLvt559NEAxQp+PwtmMcBjiR1/LMeSwFJHfH8N2QQAoUXrTp66hVFApGn+DyvmwhBCJ+zPDLfC4FHm7A7+OZRQ0RVK3n7K1aFQlCmeD0wXEqBSF6yu/QgDIHHGvB7+OZRQ0RVK3n7K1aFQlCmeD0wXEqBSF6yu/QgDIHHGvB7+OZRQ0RVK3n7K1aFQlCmeD0wXEqBSF6yu/QgDIHHGvB7+OZRQ0RVK3n7K1aFQlCmeD0wXEqBSF6yu/QgDIHHGvB7+OZRQ0RVK3n7K1aFQlCmeD0wXEqBSF6yu/QgDIHHGvB7+OZRQ0RVK3n7K1aFQlCmeD0wXEqBSF6yu/QgDIHHGvB7+OZRRERAABXQVZFZm10IBAAAAABAAEAQB8AAEAfAAABAAgAZGF0YQoGAACBhYqFbF1fdJivrJBhNjVgodDbq2EcBj+a2/LDciUFLIHO8tiJNwgZaLvt559NEAxQp+PwtmMcBjiR1/LMeSwFJHfH8N2QQAoUXrTp66hVFApGn+DyvmwhBCJ+zPDLfC4FHm7A7+OZRQ0RVK3n7K1aFQlCmeD0wXEqBSF6yu/QgDIHHGvB7+OZRQ0RVK3n7K1aFQlCmeD0wXEqBSF6yu/QgDIHHGvB7+OZRQ0RVK3n7K1aFQlCmeD0wXEqBSF6yu/QgDIHHGvB7+OZRQ0RVK3n7K1aFQlCmeD0wXEqBSF6yu/QgDIHHGvB7+OZRQ0RVK3n7K1aFQlCmeD0wXEqBSF6yu/QgDIHHGvB7+OZRQ0RVK3n7K1aFQlCmeD0wXEqBSF6yu/QgDIHHGvB7+OZRRERAABXQVZFZm10IBAAAAABAAEAQB8AAEAfAAABAAgAZGF0YQoGAACBhYqFbF1fdJivrJBhNjVgodDbq2EcBj+a2/LDciUFLIHO8tiJNwgZaLvt559NEAxQp+PwtmMcBjiR1/LMeSwFJHfH8N2QQAoUXrTp66hVFApGn+DyvmwhBCJ+zPDLfC4FHm7A7+OZRQ==').play();
            } catch (e) { }
        }

        // Show error state
        function showError(message) {
            hideAllStates();
            document.getElementById('errorMessage').textContent = message;
            document.getElementById('errorState').classList.remove('hidden');
        }

        // Check WhatsApp status
        async function checkStatus() {
            try {
                const response = await fetch(`/whatsapp/status-public/${customerId}`, {
                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                });

                const data = await response.json();

                if (data.success && data.status === 'ready') {
                    showConnected(data.phone_number, data.name);
                    return true;
                }

                return false;
            } catch (error) {
                console.error('Error checking status:', error);
                return false;
            }
        }

        // Get QR Code
        async function getQRCode() {
            try {
                const response = await fetch(`/whatsapp/qr-public/${customerId}`, {
                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                });

                const data = await response.json();

                console.log('QR Response:', data);

                if (data.success && data.qr) {
                    showQR(data.qr);

                    // Start checking status every 3 seconds
                    checkInterval = setInterval(checkStatus, 3000);
                } else if (data.need_setup) {
                    // Need to setup session first
                    throw new Error('need_setup');
                } else {
                    // QR not ready yet, throw error to trigger retry
                    throw new Error(data.message || 'QR code not ready yet');
                }
            } catch (error) {
                if (error.message === 'need_setup') {
                    throw error; // Re-throw to be caught by initialize
                } else {
                    throw error; // Re-throw to trigger retry
                }
            }
        }

        // Retry getting QR code with delays
        async function retryGetQR(maxRetries = 5, delay = 2000) {
            for (let i = 0; i < maxRetries; i++) {
                try {
                    if (i > 0) {
                        showLoading(`جاري المحاولة ${i + 1}/${maxRetries}...`);
                    }
                    await getQRCode();
                    return; // Success!
                } catch (error) {
                    if (error.message === 'need_setup') {
                        throw error; // Re-throw setup errors
                    }

                    console.log(`QR attempt ${i + 1}/${maxRetries} failed, retrying...`);

                    if (i < maxRetries - 1) {
                        // Wait before next retry
                        await new Promise(resolve => setTimeout(resolve, delay));
                    } else {
                        // Last attempt failed
                        showError('فشل في الحصول على QR Code بعد عدة محاولات. يرجى المحاولة مرة أخرى.');
                    }
                }
            }
        }

        // Setup WhatsApp Session
        async function setupSession() {
            try {
                showLoading();

                const response = await fetch(`/whatsapp/setup-public/${customerId}`, {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                });

                const data = await response.json();

                if (data.success) {
                    // Show waiting message
                    showLoading('جاري إنشاء الجلسة... انتظر قليلاً');

                    // Wait 5 seconds for QR generation, then retry up to 5 times
                    setTimeout(() => {
                        retryGetQR();
                    }, 5000);
                } else {
                    throw new Error(data.message || 'فشل في إنشاء الجلسة');
                }
            } catch (error) {
                showError(error.message);
            }
        }

        // Initialize
        async function initialize() {
            showLoading('جاري التحقق من الاتصال...');

            // First check if already connected
            const isConnected = await checkStatus();

            if (!isConnected) {
                // Check if session_id exists in database by trying to get QR
                try {
                    showLoading('جاري البحث عن الجلسة...');
                    await getQRCode();
                } catch (error) {
                    if (error.message === 'need_setup') {
                        // No session in database, setup new one
                        console.log('No session in database, setting up new session...');
                        setupSession();
                    } else {
                        // Session exists but QR not ready on server, need to create session on Node.js
                        console.log('Session in database but not on Node.js server, creating session...');
                        setupSession();
                    }
                }
            }
        }

        // Start when page loads
        document.addEventListener('DOMContentLoaded', initialize);

        // Cleanup on page unload
        window.addEventListener('beforeunload', () => {
            if (checkInterval) {
                clearInterval(checkInterval);
            }
        });
    </script>
</body>

</html>