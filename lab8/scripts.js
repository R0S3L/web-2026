// ============================================================
// 8_1.js — isPrimeNumber
// ============================================================

function isPrimeNumber(input) {
    if (typeof input === 'number') {
        if (!Number.isInteger(input)) {
            console.log("Ошибка: число должно быть целым");
            return;
        }
        const result = isPrime(input);
        console.log(`${input} ${result ? 'простое число' : 'не простое число'}`);
    }
    else if (Array.isArray(input)) {
        for (let i = 0; i < input.length; i++) {
            if (typeof input[i] !== 'number' || !Number.isInteger(input[i])) {
                console.log("Ошибка: все элементы массива должны быть целыми числами");
                return;
            }
        }

        let primeNumbers = [];
        let nonPrimeNumbers = [];

        for (let i = 0; i < input.length; i++) {
            if (isPrime(input[i])) {
                primeNumbers.push(input[i]);
            } else {
                nonPrimeNumbers.push(input[i]);
            }
        }

        if (primeNumbers.length > 0 && nonPrimeNumbers.length === 0) {
            console.log(`${primeNumbers.join(', ')} простые числа`);
        } else if (primeNumbers.length === 0 && nonPrimeNumbers.length > 0) {
            console.log(`${nonPrimeNumbers.join(', ')} не простые числа`);
        } else if (primeNumbers.length > 0 && nonPrimeNumbers.length > 0) {
            console.log(`${primeNumbers.join(', ')} простые числа, ${nonPrimeNumbers.join(', ')} не простые числа`);
        }
    }
    else {
        console.log("Ошибка: параметр должен быть числом или массивом чисел");
    }
}

// Вспомогательная функция для проверки, является ли число простым
function isPrime(num) {
    // Числа меньше 2 не являются простыми
    if (num < 2) {
        return false;
    }
    // Проверка делителей от 2 до num-1
    for (let i = 2; i < num; i++) {
        if (num % i === 0) {
            return false;
        }
    }
    return true;
}


// ============================================================
// 8_2.js — countVowels
// ============================================================

function countVowels(str) {
    if (typeof str !== 'string') {
        console.log("Ошибка: параметр должен быть строкой");
        return 0;
    }

    const vowels = "аеёиоуыэюя";

    let count = 0;
    let foundVowels = [];

    for (let i = 0; i < str.length; i++) {
        const ch = str[i].toLowerCase();
        if (vowels.includes(ch)) {
            count++;
            foundVowels.push(ch);
        }
    }

    if (count > 0) {
        console.log(`${count} (${foundVowels.join(', ')})`);
    } else {
        console.log(`0 (гласных нет)`);
    }

    return count;
}


// ============================================================
// 8_3.js — uniqueElements
// ============================================================

function uniqueElements(arr) {
    if (!Array.isArray(arr)) {
        console.log("Ошибка: параметр должен быть массивом");
        return [];
    }

    const seen = new Set();
    const result = [];

    for (let i = 0; i < arr.length; i++) {
        if (!seen.has(arr[i])) {
            seen.add(arr[i]);
            result.push(arr[i]);
        }
    }

    console.log(result);
    return result;
}


// ============================================================
// 8_4.js — mergeObjects
// ============================================================

function mergeObjects(obj1, obj2) {
    if (typeof obj1 !== 'object' || obj1 === null || Array.isArray(obj1)) {
        console.log("Ошибка: первый параметр должен быть объектом");
        return {};
    }

    if (typeof obj2 !== 'object' || obj2 === null || Array.isArray(obj2)) {
        console.log("Ошибка: второй параметр должен быть объектом");
        return {};
    }

    const result = { ...obj1 };

    for (let key in obj2) {
        if (obj2.hasOwnProperty(key)) {
            result[key] = obj2[key];
        }
    }

    return result;
}


// ============================================================
// 8_5.js — selectNames
// ============================================================

function selectNames(users) {
    if (!Array.isArray(users)) {
        console.log("Ошибка: параметр должен быть массивом");
        return [];
    }

    const names = users.map(user => user.name);
    console.log(names);
    return names;
}


// ============================================================
// 8_6.js — mapObject
// ============================================================

function mapObject(obj, callback) {
    if (typeof obj !== 'object' || obj === null || Array.isArray(obj)) {
        console.log("Ошибка: первый параметр должен быть объектом");
        return {};
    }

    if (typeof callback !== 'function') {
        console.log("Ошибка: второй параметр должен быть функцией");
        return {};
    }

    const result = {};

    for (let key in obj) {
        if (obj.hasOwnProperty(key)) {
            result[key] = callback(obj[key]);
        }
    }

    return result;
}


// ============================================================
// 8_7.js — passwordGen
// ============================================================

function passwordGen(len) {
    const upperChars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    const lowerChars = 'abcdefghijklmnopqrstuvwxyz';
    const digits     = '0123456789';
    const special    = '!@#$%^&*()_+-=[]{}';
    const allChars   = upperChars + lowerChars + digits + special;

    if (typeof len !== 'number') {
        console.log('Ошибка: Неправильный формат');
        return;
    }

    if (len <= 7 || len >= 50) {
        console.log('Ошибка: Недопустимая длина');
        return;
    }

    let password = '';
    for (let i = 0; i < len; i++) {
        password += allChars[Math.floor(Math.random() * allChars.length)];
    }

    console.log(password);
    return password;
}
