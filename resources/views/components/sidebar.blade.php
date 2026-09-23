@props(['active' => 'dashboard'])

<aside class="w-64 bg-white border-r border-gray-200 shadow-lg min-h-screen hidden md:block relative z-20">
    <div class="h-16 flex items-center px-6 border-b border-gray-200">
        <h2 class="text-xl font-bold text-brand-green">Menu</h2>
    </div>
    <nav class="p-4 space-y-2">
        <a href="#" 
           class="block px-4 py-2 rounded-lg font-medium transition-all {{ $active === 'dashboard' ? 'bg-emerald-600 text-white shadow-md' : 'text-gray-600 hover:bg-emerald-50 hover:text-emerald-700' }}">
           Dashboard
        </a>
        <a href="#" 
           class="block px-4 py-2 rounded-lg font-medium transition-all {{ $active === 'profil' ? 'bg-emerald-600 text-white shadow-md' : 'text-gray-600 hover:bg-emerald-50 hover:text-emerald-700' }}">
           Profil
        </a>
        <a href="#" 
           class="block px-4 py-2 rounded-lg font-medium transition-all {{ $active === 'pengaturan' ? 'bg-emerald-600 text-white shadow-md' : 'text-gray-600 hover:bg-emerald-50 hover:text-emerald-700' }}">
           Pengaturan
        </a>
    </nav>
</aside>
