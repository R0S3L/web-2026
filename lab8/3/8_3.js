function uniqueElements(arr) {
    if (!Array.isArray(arr)) {
        console.log("Ошибка: параметр должен быть массивом");
        return {};
    }
    
    const result = {};
    
    for (let i = 0; i < arr.length; i++) {
        const key = String(arr[i]);
        
        if (result[key]) {
            result[key]++;
        } else {
            result[key] = 1;
        }
    }
    
    return result;
}