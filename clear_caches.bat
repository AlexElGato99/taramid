@echo off
echo Clearing Laravel Caches...
echo.
C:\xampp\php\php artisan cache:clear
C:\xampp\php\php artisan config:clear
C:\xampp\php\php artisan route:clear
C:\xampp\php\php artisan view:clear
echo.
echo Caches cleared successfully!
echo.
echo If you have Composer installed globally, run:
echo composer dump-autoload
echo.
echo Otherwise, try refreshing your browser (Ctrl+F5)
echo.
pause
