<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Create Admin Account | Khalsa Agro</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; overflow: hidden; }
        .auth-split { background: linear-gradient(135deg, #0f172a 0%, #1e3a8a 100%); }
        .input-focus:focus { box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1); }
        /* Custom scrollbar for small height screens if needed */
        .form-container::-webkit-scrollbar { width: 4px; }
        .form-container::-webkit-scrollbar-thumb { background: #e2e8f0; border-radius: 10px; }
    </style>
</head>
<body class="bg-slate-50 min-h-screen flex items-center justify-center overflow-hidden">

    <div class="flex w-full h-screen shadow-2xl overflow-hidden">
        
        <div class="hidden lg:flex lg:w-1/2 auth-split relative items-center justify-center p-12">
            <div class="absolute inset-0 opacity-10" style="background-image: url('https://www.transparenttextures.com/patterns/carbon-fibre.png');"></div>
            <div class="relative z-10 text-center">
                <div class="bg-white/10 backdrop-blur-lg p-10 rounded-[2rem] border border-white/10 inline-block mb-6 shadow-2xl">
                    <h1 class="text-5xl font-black text-white tracking-tighter mb-2">KHALSA <span class="text-blue-400">AGRO</span></h1>
                    <p class="text-blue-200 text-lg font-medium opacity-80 italic">Authorized Access Only</p>
                </div>
                <p class="text-white/60 text-sm max-w-sm mx-auto leading-relaxed">
                    Setting up a new administrative account grants full control over dealer certifications and data management.
                </p>
            </div>
            <div class="absolute -top-24 -right-24 w-96 h-96 bg-blue-500/10 rounded-full blur-3xl"></div>
        </div>

        <div class="w-full lg:w-1/2 bg-white flex flex-col justify-center px-8 md:px-16 lg:px-24 relative overflow-y-auto form-container">
            
            <div class="max-w-md w-full mx-auto py-8">
                <div class="mb-8 text-center lg:text-left">
                    <h2 class="text-3xl font-bold text-slate-900 mb-2">Create Admin</h2>
                    <p class="text-slate-500 font-medium">Register a new system administrator</p>
                </div>

                <form method="POST" action="{{ route('register') }}" class="space-y-5">
                    @csrf

                    <div>
                        <label class="block text-[10px] font-bold text-slate-500 mb-1.5 tracking-widest uppercase">Full Identity</label>
                        <input type="text" name="name" value="{{ old('name') }}" required autofocus
                            class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl py-3.5 px-4 outline-none transition-all duration-300 focus:border-blue-500 input-focus"
                            placeholder="John Doe">
                        @error('name') <span class="text-rose-500 text-[11px] mt-1 font-semibold">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-[10px] font-bold text-slate-500 mb-1.5 tracking-widest uppercase">Official Email</label>
                        <input type="email" name="email" value="{{ old('email') }}" required
                            class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl py-3.5 px-4 outline-none transition-all duration-300 focus:border-blue-500 input-focus"
                            placeholder="admin@khalsagro.com">
                        @error('email') <span class="text-rose-500 text-[11px] mt-1 font-semibold">{{ $message }}</span> @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-[10px] font-bold text-slate-500 mb-1.5 tracking-widest uppercase">Security Key</label>
                            <input type="password" name="password" required
                                class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl py-3.5 px-4 outline-none transition-all duration-300 focus:border-blue-500 input-focus"
                                placeholder="••••••••">
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold text-slate-500 mb-1.5 tracking-widest uppercase">Confirm Key</label>
                            <input type="password" name="password_confirmation" required
                                class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl py-3.5 px-4 outline-none transition-all duration-300 focus:border-blue-500 input-focus"
                                placeholder="••••••••">
                        </div>
                    </div>
                    @error('password') <span class="text-rose-500 text-[11px] font-semibold">{{ $message }}</span> @enderror

                    <div class="pt-2">
                        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-4 rounded-xl shadow-lg shadow-blue-100 transition-all duration-300 flex items-center justify-center space-x-2 active:scale-[0.98]">
                            <span>Complete Registration</span>
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path></svg>
                        </button>
                    </div>

                    <div class="text-center">
                        <a href="{{ route('login') }}" class="text-xs font-bold text-slate-400 hover:text-blue-600 transition-colors">
                            ALREADY HAVE AN ACCOUNT? <span class="text-blue-600">SIGN IN</span>
                        </a>
                    </div>
                </form>

                <div class="mt-10 text-center lg:text-left pt-6 border-t border-slate-100">
                    <p class="text-slate-400 text-[10px] font-bold tracking-widest uppercase">
                        Enterprise Grade Security &bull; Khalsa Agro Industries
                    </p>
                </div>
            </div>
        </div>
    </div>

</body>
</html>