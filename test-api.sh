#!/bin/bash

# Ali Debo API Test Script

BASE_URL="http://localhost/alidebo/public/api"

echo "================================"
echo "Testing Ali Debo API"
echo "================================"
echo ""

# Test 1: Get Categories (Arabic)
echo "1. Testing GET /categories?lang=ar"
curl -s "${BASE_URL}/categories?lang=ar" | jq '.'
echo ""
echo "---"
echo ""

# Test 2: Get Categories (English)
echo "2. Testing GET /categories?lang=en"
curl -s "${BASE_URL}/categories?lang=en" | jq '.'
echo ""
echo "---"
echo ""

# Test 3: Get Countries
echo "3. Testing GET /countries?lang=ar"
curl -s "${BASE_URL}/countries?lang=ar" | jq '.'
echo ""
echo "---"
echo ""

# Test 4: Get Companies
echo "4. Testing GET /companies?lang=ar&per_page=5"
curl -s "${BASE_URL}/companies?lang=ar&per_page=5" | jq '.'
echo ""
echo "---"
echo ""

# Test 5: Search Companies
echo "5. Testing GET /companies/search?q=test&lang=ar"
curl -s "${BASE_URL}/companies/search?q=test&lang=ar" | jq '.'
echo ""
echo "---"
echo ""

# Test 6: Get Advertisements
echo "6. Testing GET /advertisements"
curl -s "${BASE_URL}/advertisements" | jq '.'
echo ""
echo "---"
echo ""

# Test 7: Get Settings
echo "7. Testing GET /settings"
curl -s "${BASE_URL}/settings" | jq '.'
echo ""
echo "---"
echo ""

# Test 8: Login (will fail without valid credentials)
echo "8. Testing POST /login (Expected to fail - no valid credentials)"
curl -s -X POST "${BASE_URL}/login" \
  -H "Content-Type: application/json" \
  -d '{"email":"test@example.com","password":"wrongpassword"}' | jq '.'
echo ""
echo "---"
echo ""

# Test 9: Register
echo "9. Testing POST /register"
curl -s -X POST "${BASE_URL}/register" \
  -H "Content-Type: application/json" \
  -d '{
    "name":"Test Company",
    "email":"testcompany'$(date +%s)'@example.com",
    "password":"password123",
    "password_confirmation":"password123"
  }' | jq '.'
echo ""
echo "---"
echo ""

# Test 10: Get Profile (without token - should fail)
echo "10. Testing GET /profile (Expected to fail - no token)"
curl -s "${BASE_URL}/profile" | jq '.'
echo ""

echo "================================"
echo "API Testing Complete"
echo "================================"
