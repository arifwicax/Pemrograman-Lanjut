
# Week 4 Namespace, Autoloading, Exception, MySQL Object

## 1. Namespace

### 📌 Pengertian

* **Namespace** adalah cara untuk mengelompokkan kelas, fungsi, atau konstanta agar tidak terjadi benturan nama (name conflict).
* Cocok digunakan ketika proyek semakin besar dan ada banyak file/kode.

### 📌 Contoh Sederhana

```php
<?php
// File: Library/Math/Calculator.php
namespace Library\Math;

class Calculator {
    public function add($a, $b) {
        return $a + $b;
    }
}
```

```php
<?php
// File: Library/Text/Calculator.php
namespace Library\Text;

class Calculator {
    public function concat($a, $b) {
        return $a . " " . $b;
    }
}
```

```php
<?php
// File: main.php
require 'Library/Math/Calculator.php';
require 'Library/Text/Calculator.php';

use Library\Math\Calculator as MathCalc;
use Library\Text\Calculator as TextCalc;

$math = new MathCalc();
echo $math->add(5, 3); // Output: 8

$text = new TextCalc();
echo $text->concat("Hello", "World"); // Output: Hello World
```

✅ Dengan namespace, meskipun ada 2 class `Calculator`, tetap bisa digunakan tanpa bentrok.

---

## 2. Autoloading

### 📌 Pengertian

* **Autoloading** adalah mekanisme untuk memanggil file class secara otomatis tanpa harus `require` satu per satu.
* PHP menyediakan fungsi **`spl_autoload_register()`** untuk membuat autoloader sendiri.
* Composer (alat manajemen package) juga memakai autoloading.

### 📌 Contoh Autoloading Manual

```php
<?php
// autoload.php
spl_autoload_register(function ($class) {
    $path = str_replace("\\", "/", $class) . ".php";
    if (file_exists($path)) {
        require $path;
    }
});
```

```php
<?php
// File: Models/User.php
namespace Models;

class User {
    public function getName() {
        return "Arif Wicaksono";
    }
}
```

```php
<?php
// File: index.php
require 'autoload.php';

use Models\User;

$user = new User();
echo $user->getName(); // Output: Arif Wicaksono
```

✅ Praktis, tidak perlu `require` banyak file lagi.

---

## 3. Exception

### 📌 Pengertian

* **Exception** digunakan untuk menangani error agar program tidak langsung berhenti.
* Gunakan blok **try – catch – finally**.

### 📌 Contoh Exception Dasar

```php
<?php
function divide($a, $b) {
    if ($b == 0) {
        throw new Exception("Tidak bisa membagi dengan nol!");
    }
    return $a / $b;
}

try {
    echo divide(10, 2); // Output: 5
    echo divide(10, 0); // Akan memicu exception
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
} finally {
    echo " - Program selesai.";
}
```

### 📌 Contoh Custom Exception

```php
<?php
class InvalidAgeException extends Exception {}

function setAge($age) {
    if ($age < 0) {
        throw new InvalidAgeException("Umur tidak boleh negatif!");
    }
    return "Umur: $age";
}

try {
    echo setAge(-5);
} catch (InvalidAgeException $e) {
    echo "Terjadi error: " . $e->getMessage();
}
```

✅ Dengan custom exception, error bisa lebih spesifik.

---

# ✨ Kesimpulan

1. **Namespace** → Menghindari benturan nama (seperti folder dalam file system).
2. **Autoloading** → Memanggil class otomatis, tidak perlu `require` manual.
3. **Exception** → Menangani error dengan cara lebih aman dan rapi.
