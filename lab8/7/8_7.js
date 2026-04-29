function passwordGen(len) {
    const chars = {
        upperChars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ',
        lowerChard = 'abcdefghijklmnopqrstuvwxyz'
    }
    if (typeof len == 'number') {
        if (len > 7 && len < 50) {
            
        } else {
            console.log('Ошибка: Недопустимая длинна')
        }
    } else {
        console.log('Ошибка: Неправильный формат')
    }
}