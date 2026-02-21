<!DOCTYPE html>
<html>
<head>
    <title>Adverse Reaction Report</title>
</head>
<body>
    <h2>
        Сообщение о побочной реакции успешно отправлено. Благодарим вас за предоставленную информацию.
    </h2>
    <p><strong>Лицо сообщающее о НР:</strong> {{ $data['person_reporting'] ?? 'N/A' }}</p>
    <p><strong>ФИО:</strong> {{ $data['full_name'] ?? 'N/A' }}</p>
    <p><strong>Должность и место работы:</strong> {{ $data['position_work_place'] ?? 'N/A' }}</p>
    <p><strong>E-Mail:</strong> {{ $data['email'] ?? 'N/A' }}</p>
    <p><strong>Дата сообщения:</strong> {{ $data['date_of_message'] ?? 'N/A' }}</p>
    
    <h3>Информация о пациенте:</h3>
    <p><strong>Инициалы пациента (код):</strong> {{ $data['patient_initials_code'] ?? 'N/A' }}</p>
    <p><strong>Вес:</strong> {{ $data['weight'] ?? 'N/A' }}</p>
    <p><strong>Возраст:</strong> {{ $data['age'] ?? 'N/A' }}</p>
    <p><strong>Пол:</strong> {{ $data['gender'] ?? 'N/A' }}</p>
    <p><strong>Беременность:</strong> {{ $data['pregnancy'] ?? 'N/A' }}</p>
    <p><strong>Есть аллергия:</strong> {{ $data['allergy'] ?? 'N/A' }}</p>
    
    <h3>Информация о препарате, предположительно вызвавшем НР:</h3>
    <p><strong>Наименование ЛС (торговое):</strong> {{ $data['drug_name'] ?? 'N/A' }}</p>
    <p><strong>Номер серии:</strong> {{ $data['serial'] ?? 'N/A' }}</p>
    <p><strong>Производитель:</strong> {{ $data['manufacturer'] ?? 'N/A' }}</p>
    <p><strong>Доза, путь введения:</strong> {{ $data['dose'] ?? 'N/A' }}</p>
    <p><strong>Дата начала приема:</strong> {{ $data['admission_start_date'] ?? 'N/A' }}</p>
    <p><strong>Дата прекращения приема:</strong> {{ $data['discontinuation_end_date'] ?? 'N/A' }}</p>
    
    <h3>Информация о нежелательной реакции:</h3>
    <p>
        <strong>
            Описание реакции (укажите все детали, включая данные лабораторных исследований):</strong>
         {{ $data['description_of_reaction'] ?? 'N/A' }}
    </p>
    <p><strong>Дата начала НР:</strong> {{ $data['start_date_of_nr'] ?? 'N/A' }}</p>
    <p><strong>Дата прекращения НР:</strong> {{ $data['nr_termination_date'] ?? 'N/A' }}</p>
    
    <h3>Критерии серьезности НР:</h3>
    <p>{{ $data['criteria_for_the_severity'] ?? 'N/A' }}</p>

    <h3>Предпринятые меры:</h3>
    <p>{{ $data['measures_taken'] ?? 'N/A' }}</p>

    <h3>Исход:</h3>
    <p>{{ $data['exodus'] ?? 'N/A' }}</p>

    <h3>Сопровождалось ли отмена ЛС исчезновением НПР?:</h3>
    <p>{{ $data['was_the_discontinuation'] ?? 'N/A' }}</p>

    <h3>Отмечено ли повторение НПР после повторного назначения ЛС?:</h3>
    <p>{{ $data['was_there_a_recurrence'] ?? 'N/A' }}</p>
    
    
    @if(isset($data['omt_name']) && count($data['omt_name']) > 0)
        <h3>Другие препараты, принимаемые пациентом в течение последних 3 месяцев, включая ЛС принимаемые самостоятельно (по собственному желанию):</h3>
        @foreach($data['omt_name'] as $index => $name)
            @if(!empty($name))
                <div style="margin-bottom: 15px; padding: 10px; border: 1px solid #ccc;">
                    <p><strong>Наименование ЛС (торговое):</strong> {{ $name }}</p>
                    <p><strong>Номер серии:</strong> {{ $data['omt_serial'][$index] ?? 'N/A' }}</p>
                    <p><strong>Производитель:</strong> {{ $data['omt_manufacturer'][$index] ?? 'N/A' }}</p>
                    <p><strong>Доза, путь введения:</strong> {{ $data['omt_dose'][$index] ?? 'N/A' }}</p>
                    <p><strong>Дата начала приема:</strong> {{ $data['omt_date_start'][$index] ?? 'N/A' }}</p>
                    <p><strong>Дата прекращения приема:</strong> {{ $data['omt_date_end'][$index] ?? 'N/A' }}</p>
                </div>
            @endif
        @endforeach
    @endif
</body>
</html>