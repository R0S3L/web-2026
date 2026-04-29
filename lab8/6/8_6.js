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
