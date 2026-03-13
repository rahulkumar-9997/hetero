<h2>Новый запрос</h2>
<p><strong>Имя:</strong> {{ $enquiry['name'] }}</p>
<p><strong>Электронная почта:</strong> {{ $enquiry['email'] ?? 'N/A' }}</p>
<p><strong>Сообщение:</strong> {{ $enquiry['message'] ?? 'N/A' }}</p>
