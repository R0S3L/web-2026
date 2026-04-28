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