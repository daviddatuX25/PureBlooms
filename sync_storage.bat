@echo off
echo Syncing storage files to public directory...
cd /d "c:\xampp\htdocs\1131"

echo Removing old public/storage directory...
rmdir /s /q "public\storage" 2>nul

echo Creating new public/storage directory...
mkdir "public\storage"

echo Copying files from storage/app/public to public/storage...
xcopy "storage\app\public\*" "public\storage\" /E /I /Y

echo Storage sync complete!
echo.
echo Images should now be accessible at:
echo http://localhost/1131/public/storage/products/
echo http://localhost/1131/public/storage/logos/
pause
