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
