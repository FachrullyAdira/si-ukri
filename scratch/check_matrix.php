<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\User;

$users = [
    'Super Admin' => User::where('email', 'superadmin@ukri.ac.id')->first(),
    'Admin Akademik' => User::where('email', 'akademik@ukri.ac.id')->first(),
    'Editor Konten' => User::where('email', 'humas@ukri.ac.id')->first(),
    'Admin Kemahasiswaan' => User::where('email', 'kemahasiswaan@ukri.ac.id')->first(),
    'Dosen' => User::where('email', 'dosen@ukri.ac.id')->first(),
    'Mahasiswa' => User::where('email', 'mahasiswa@ukri.ac.id')->first(),
];

$files = glob(app_path('Filament/Resources/*Resource.php'));

$matrix = [];

foreach ($files as $file) {
    $className = 'App\\Filament\\Resources\\' . basename($file, '.php');
    $group = $className::getNavigationGroup() ?? 'None';
    $label = $className::getNavigationLabel() ?? class_basename($className);
    $model = $className::getModel();
    
    $row = [
        'Resource' => class_basename($className),
        'Group' => $group,
    ];
    
    foreach ($users as $roleName => $user) {
        if (!$user) {
            $row[$roleName] = 'No User';
            continue;
        }
        $canViewAny = $className::canViewAny();
        // simulate authenticated user
        auth()->login($user);
        $canViewAny = $className::canViewAny();
        $canCreate = $className::canCreate();
        $row[$roleName] = ($canViewAny ? 'V' : '-') . ($canCreate ? 'C' : '-');
    }
    $matrix[] = $row;
}

echo sprintf("%-28s | %-24s | %-6s | %-6s | %-6s | %-6s | %-6s | %-6s\n", 
    "Resource", "Group", "S-Admin", "Akademik", "Editor", "Kemhswn", "Dosen", "Mhs");
echo str_repeat('-', 110) . "\n";

foreach ($matrix as $r) {
    echo sprintf("%-28s | %-24s | %-6s | %-6s | %-6s | %-6s | %-6s | %-6s\n",
        $r['Resource'], $r['Group'], $r['Super Admin'], $r['Admin Akademik'], $r['Editor Konten'], $r['Admin Kemahasiswaan'], $r['Dosen'], $r['Mahasiswa']);
}
