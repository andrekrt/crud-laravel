<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Permissões</title>
</head>
<body style="font-size: 12px">
    <h2 style="text-align: center">Permissões</h2>
    <table style="border-collapse: collapse; width: 100%">
        <thead>
            <tr style="background-color: #adb5bd">
                <th style="border: 1px solid #ccc">ID</th>
                <th style="border: 1px solid #ccc">Página</th>
                <th style="border: 1px solid #ccc">Permissão</th>
                <th style="border: 1px solid #ccc">Data de Cadastro</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($permissions as $permission )
                <tr>
                    <td style="border: 1px solid #ccc; text-align: center; ">{{ $permission->id }}</td>
                    <td style="border: 1px solid #ccc; text-align: center; ">{{ $permission->title }}</td>
                    <td style="border: 1px solid #ccc; text-align: center; ">{{ $permission->name }}</td>
                    <td style="border: 1px solid #ccc; text-align: center; ">{{ \Carbon\Carbon::parse($permission->created_at)->tz('America/Sao_Paulo')->format('d/m/Y H:i:s') }}</td>
                </tr>
            @empty
                 <tr>
                    <td colspan="4" style="border: 1px solid #ccc; text-align: center; color:red">Nenhum usuário encontrado!</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
