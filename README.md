# Тестовое задание (библиотека Sanitizer)

Ссылка на тз: https://docs.google.com/document/d/1SLvbJ1hs3X3my3-gZJ7LsNtTa31IEVF0p6seTML-Efo/edit

# Использование:

Получение валидного массива данных:

Sanitizer::sanitize($json, $params); , где $json - это передаваемая строка в формате json, а $params - массив строк с именами допустимых типов данных.

В случае передачи каких-либо неверных данных будет выброшена ошибка с комментарием. В случае успеха метод возвращает ассоциативный массив с данными из $json

Получение списка допустимых типов данных:

Sanitizer::showDataTypes();

Проверка типа данных или списка типа данных:

Sanitizer::validateDataType($string);
Sanitizer::validateDataTypeArray($array);

Если тип данных недопустим, будет выброшена ошибка.

Для добавления нового типа данных необходимо создать новый файл [NewDataType].php в подкаталоге dataTypes и прописать в нем условие валидности данного типа данных в методе isInstance() по следующему шаблону:

class NewDataType extends DataType
{
protected function isInstance(): bool
{
// условие валидности данного типа данных
if ($isValid) return true;
else return false;
}
}
