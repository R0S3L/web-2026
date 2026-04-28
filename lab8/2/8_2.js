function countVowels(str) {
    if (typeof str !== 'string') {
        console.log("Ошибка: параметр должен быть строкой");
        return 0;
    }
    
    const vowels = "аеёиоуыэюя";
    
    let count = 0;
    let foundVowels = []; 
       
    if (count > 0) {
        console.log(`${count} (${foundVowels.join(', ')})`);
    } else {
        console.log(`0 (гласных нет)`);
    }
    
    return count;
}
