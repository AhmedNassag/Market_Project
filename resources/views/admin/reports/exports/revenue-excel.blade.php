<table>
    <thead>
        <th class="text-center">#</th>
        <th class="text-center">التاريج</th>
        <th class="text-center">الإجمالى</th>
    </thead>
    <tbody>
        @forelse ($reports as $report)
            <tr>    
                <td class="text-center">{{ $loop->iteration }}</td>
                <td class="text-center">{{ $report['date'] }}</td>
                <td class="text-center">${{ $report['revenue'] }}</td>
            </tr>
        @empty
            <tr>
                <td class="text-center">لا توجد بيانات</td>
            </tr>
        @endforelse

        @if ($reports)
            <tr>
                <td class="text-center">الإجمالى</td>
                <td class="text-center"></td>
                <td class="text-center"><strong>${{ number_format($total_revenue,2) }}</strong></td>
            </tr>
        @endif
    </tbody>
</table>