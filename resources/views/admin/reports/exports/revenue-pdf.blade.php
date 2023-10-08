<!DOCTYPE html>
<html>
  	<head>
		<meta charset="utf-8">
		<title>تقرير</title>
		<style type="text/css">
			table {
				width: 100%;
			}

			table tr td,
			table tr th {
				font-size: 10pt;
				text-align: center;
			}

			table tr:nth-child(even) {
				background-color: #f2f2f2;
			}

			table th, td {
  				border-bottom: 1px solid #ddd;
			}

			table th {
				border-top: 1px solid #ddd;
				height: 40px;
			}

			table td {
				height: 25px;
			}
		</style>
	</head>
  	<body>
		<h2>تقرير</h2>
		<hr>
		<p>Period : {{ $endDate }} - {{ $startDate }}</p>
		<table class="table table-bordered table-striped">
            <thead>
                <th class="text-center">#</th>
                <th class="text-center">التاريخ</th>
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
                        <td colspan="6" class="text-center">لا توجد بيانات</td>
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
 	</body>
</html>