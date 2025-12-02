<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>検索結果</title>
</head>
<body>

  <h1>Search Results</h1>
  @if(isset($companies) && count($companies) > 0)
    <ul>
      @foreach($companies as $company)
        <li>{{ $company->name }} - {{ $company->email }}</li>
      @endforeach
    </ul>
  @else
    <p>No results found.</p>
  @endif
</body>
</html>