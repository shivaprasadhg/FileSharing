# 🕵️ HackerShare – Local Apache2 File Sharing Webpage

A hacker-themed, password-protected file sharing portal designed to run on a local Apache2 server on Linux. Uploaded files are saved in a shared folder on your Desktop and made available for download on the same network.

---

## 🚀 Features

✅ Hacker-style glitch UI with neon green text  
✅ Password-protected access to the site (`admin123`)  
✅ Upload any file – no size or type restrictions  
✅ Displays and downloads files stored in shared folder  
✅ Fully offline – works over local Wi-Fi or LAN  
✅ Ready for GitHub and local deployment  

---

## 🧰 Requirements

- Linux (Ubuntu/Debian recommended)
- Apache2 Web Server
- PHP 7.x or 8.x
- Git (for cloning)
- A modern web browser

---

## 🛠️ Step-by-Step Setup Guide

1️⃣ Install Apache2 and PHP

    sudo apt update
    sudo apt install apache2 php libapache2-mod-php
    sudo systemctl restart apache2

2️⃣ Clone the Project from GitHub

    git clone https://github.com/shivaprasadhg/FileSharing
    cd FileSharing

3️⃣ Copy the Webpage to Apache Web Root

    sudo cp index.php /var/www/html/index.php

4️⃣ Create the Shared Folder on Your Desktop

    mkdir -p ~/Desktop/shared_files
    sudo chmod -R 755 ~/Desktop/shared_files
    sudo chown -R www-data:www-data ~/Desktop/shared_files

5️⃣ Create a Symlink to the Shared Folder in Web Root

    cd /var/www/html
    sudo ln -s /home/$USER/Desktop/shared_files files

This allows the webpage to access and display files via files/

6️⃣ Increase PHP File Upload Limits

Edit your php.ini file:
    sudo nano /etc/php/8.1/apache2/php.ini

Update these lines:
    upload_max_filesize = 512M
    post_max_size = 512M
    max_execution_time = 300
    max_input_time = 300
    memory_limit = 512M

Restart Apache:
    sudo systemctl restart apache2

7️⃣ Access the Website

Visit:
http://<your-local-IP>/
    Example: http://192.168.1.10/

🔐 Default Password
The default password is: admin123

You can change it in index.php:
    $correct_password = "admin123";

Author
Created by shivaprasadhg – for learning, sharing, and exploring cool hacker-themed tools.




