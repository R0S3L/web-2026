function selectNames(array) {
  let names = []
  if (Array.isArray(array)) {
    if (array.length !== 0) {
      names = array.map(function(user) {
        return user.name
      })
      console.log(names)
    } else {
      console.log('Ошибка: массив пуст')
    }
  } else {
    console.log('Ошибка: неправильный формат')
  }
}