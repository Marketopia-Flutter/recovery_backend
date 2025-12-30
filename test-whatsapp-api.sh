#!/bin/bash

# WhatsApp Multi-Session API - Test Script
# استخدم هذا الـ script لاختبار الـ endpoints

echo "🧪 Testing WhatsApp Multi-Session API"
echo "======================================"
echo ""

# Configuration
API_URL="http://localhost:8000/api"
API_KEY="YOUR_API_KEY_HERE"  # ضع الـ API key الخاص بالعميل هنا

echo "📝 Configuration:"
echo "   API URL: $API_URL"
echo "   API Key: ${API_KEY:0:10}..."
echo ""

# Test 1: Setup WhatsApp Session
echo "1️⃣  Setting up WhatsApp session..."
SETUP_RESPONSE=$(curl -s -X POST "$API_URL/whatsapp/setup" \
  -H "Authorization: Bearer $API_KEY" \
  -H "Content-Type: application/json")

echo "Response: $SETUP_RESPONSE"
echo ""

# Wait for QR generation
echo "⏳ Waiting 5 seconds for QR generation..."
sleep 5
echo ""

# Test 2: Get QR Code
echo "2️⃣  Getting QR code..."
QR_RESPONSE=$(curl -s -X GET "$API_URL/whatsapp/qr" \
  -H "Authorization: Bearer $API_KEY")

# Save QR to file (optional)
echo "$QR_RESPONSE" | grep -o '"qr":"[^"]*"' | cut -d'"' -f4 > qr_code.txt

if [ -f qr_code.txt ]; then
    echo "✅ QR code saved to qr_code.txt"
    echo "📱 Scan this QR code with your WhatsApp app"
else
    echo "Response: $QR_RESPONSE"
fi
echo ""

# Test 3: Check Status
echo "3️⃣  Checking WhatsApp status..."
STATUS_RESPONSE=$(curl -s -X GET "$API_URL/whatsapp/status" \
  -H "Authorization: Bearer $API_KEY")

echo "Response: $STATUS_RESPONSE"
echo ""

# Test 4: Send Test Message (after connection)
echo "4️⃣  Sending test message..."
read -p "Enter phone number to test (e.g., 201012345678): " PHONE_NUMBER

if [ -n "$PHONE_NUMBER" ]; then
    MESSAGE_RESPONSE=$(curl -s -X POST "$API_URL/send-message" \
      -H "Authorization: Bearer $API_KEY" \
      -H "Content-Type: application/json" \
      -d "{\"phone\":\"$PHONE_NUMBER\",\"message\":\"🧪 Test message from WhatsApp Multi-Session API\"}")
    
    echo "Response: $MESSAGE_RESPONSE"
else
    echo "⏭️  Skipped"
fi
echo ""

# Test 5: Configure Webhook
echo "5️⃣  Configuring webhook..."
WEBHOOK_RESPONSE=$(curl -s -X POST "$API_URL/whatsapp/configure-webhook" \
  -H "Authorization: Bearer $API_KEY")

echo "Response: $WEBHOOK_RESPONSE"
echo ""

echo "✅ Testing completed!"
echo ""
echo "📋 Next Steps:"
echo "   1. Check if QR code is generated (qr_code.txt)"
echo "   2. Scan the QR code with WhatsApp"
echo "   3. Check status again to confirm connection"
echo "   4. Try sending messages"
echo ""
