# PowerShell FTP Upload Script for Proagroindustria Dashboard Fix
# This script uploads the corrected Dashboard-Bsdc8Mp1.js to your Hostinger server

# CONFIGURE THESE VALUES:
$FTP_HOST = "pro-agroindustria.online"  # Get from Hostinger FTP credentials
$FTP_USER = "Admin"             # Get from Hostinger FTP credentials  
$FTP_PASS = "password"             # Get from Hostinger FTP credentials
$LOCAL_FILE = "C:\xampp\htdocs\Proagroindustria\public\build\assets\Dashboard-Bsdc8Mp1.js"
$REMOTE_PATH = "/public/build/assets/Dashboard-Bsdc8Mp1.js"

# Create FTP Request
$FTPRequest = [System.Net.FtpWebRequest]::Create("ftp://$FTP_HOST$REMOTE_PATH")
$FTPRequest.Method = [System.Net.WebRequestMethods+Ftp]::UploadFile
$FTPRequest.Credentials = New-Object System.Net.NetworkCredential($FTP_USER, $FTP_PASS)

# Read local file
$FileContent = [System.IO.File]::ReadAllBytes($LOCAL_FILE)

# Upload file
$FTPRequest.ContentLength = $FileContent.Length
$RequestStream = $FTPRequest.GetRequestStream()
$RequestStream.Write($FileContent, 0, $FileContent.Length)
$RequestStream.Close()

# Get response
$Response = $FTPRequest.GetResponse()
Write-Host "Upload Status: $($Response.StatusCode)"
$Response.Close()

Write-Host "File uploaded successfully!"
Write-Host "Visit: https://pro-agroindustria.online/dashboard"
Write-Host "Bars should now be BLUE instead of BLACK"
