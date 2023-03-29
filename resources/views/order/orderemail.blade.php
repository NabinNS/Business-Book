@component('mail::message')
**Order List**

Here is the list of orders that I want:

<table style="border-collapse: collapse; width: 100%;">
    <thead style="background-color: #ddd; font-weight: bold;">
        <tr>
            <th style="padding: 5px; border: 1px solid #ccc;">Name</th>
            <th style="padding: 5px; border: 1px solid #ccc;">Quantity</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($orderNames as $orderName)
        <tr>
            <td style="padding: 5px; border: 1px solid #ccc;">{{ $orderName->name }}</td>
            <td style="padding: 5px; border: 1px solid #ccc;">{{ $orderName->quantity }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

Thanks,<br>
{{ config('app.name') }}
@endcomponent
