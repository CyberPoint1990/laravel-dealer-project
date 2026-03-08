<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Secure Login | Khalsa Agro Industries</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { 
            font-family: 'Inter', sans-serif; 
            overflow: hidden; /* Strict No-Scroll */
        }
        .auth-split {
            background: linear-gradient(135deg, #0f172a 0%, #1e3a8a 100%);
        }
        .input-focus:focus {
            box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1);
        }
    </style>
</head>
<body class="bg-slate-50 min-h-screen flex items-center justify-center overflow-hidden">

    <div class="flex w-full h-screen shadow-2xl overflow-hidden">
        
        <div class="hidden lg:flex lg:w-3/5 auth-split relative items-center justify-center p-12">
            <div class="absolute inset-0 opacity-20" style="background-image: url('https://www.transparenttextures.com/patterns/carbon-fibre.png');"></div>
            <div class="relative z-10 text-center">
                <div class="bg-white/10 backdrop-blur-md p-8 rounded-3xl border border-white/10 inline-block mb-6">
                    <h1 class="text-5xl font-black text-white tracking-tighter mb-2">KHALSA <span class="text-blue-400">AGRO</span></h1>
                    <p class="text-blue-200 text-lg font-medium opacity-80">Next-Gen Dealer Management System</p>
                </div>
                <div class="flex justify-center space-x-4 mt-8">
                    <div class="h-1 w-12 bg-blue-500 rounded-full"></div>
                    <div class="h-1 w-4 bg-blue-500/30 rounded-full"></div>
                    <div class="h-1 w-4 bg-blue-500/30 rounded-full"></div>
                </div>
            </div>
            <div class="absolute -bottom-24 -left-24 w-96 h-96 bg-blue-600/20 rounded-full blur-3xl"></div>
        </div>

        <div class="w-full lg:w-2/5 bg-white flex flex-col justify-center px-8 md:px-16 lg:px-20 relative">
            
            <div class="max-w-md w-full mx-auto">
                <div class="mb-10 text-center lg:text-left">
                    <h2 class="text-3xl font-bold text-slate-900 mb-2">Admin Portal</h2>
                    <p class="text-slate-500 font-medium">Please enter your credentials to continue</p>
                </div>

                @if(session('status'))
                    <div class="mb-6 p-4 bg-emerald-50 text-emerald-700 rounded-xl text-sm border border-emerald-100 flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf

                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2 tracking-wide uppercase text-[10px]">Email Identity</label>
                        <div class="relative">
                            <input type="email" name="email" value="{{ old('email') }}" required autofocus 
                                class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl py-4 px-4 outline-none transition-all duration-300 focus:border-blue-500 input-focus"
                                placeholder="name@company.com">
                        </div>
                        @error('email') <span class="text-rose-500 text-xs mt-1 font-medium">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <div class="flex justify-between items-center mb-2">
                            <label class="block text-sm font-bold text-slate-700 tracking-wide uppercase text-[10px]">Security Key</label>
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="text-xs font-semibold text-blue-600 hover:underline">Reset Access?</a>
                            @endif
                        </div>
                        <input type="password" name="password" required 
                            class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-sm rounded-xl py-4 px-4 outline-none transition-all duration-300 focus:border-blue-500 input-focus"
                            placeholder="••••••••••••">
                        @error('password') <span class="text-rose-500 text-xs mt-1 font-medium">{{ $message }}</span> @enderror
                    </div>

                    <div class="flex items-center justify-between">
                        <label class="flex items-center cursor-pointer group">
                            <input id="remember_me" type="checkbox" name="remember" class="w-4 h-4 rounded border-slate-300 text-blue-600 focus:ring-blue-500 transition-all cursor-pointer">
                            <span class="ml-2 text-sm text-slate-500 font-medium group-hover:text-slate-700">Stay authenticated</span>
                        </label>
                    </div>

                    <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-4 rounded-xl shadow-lg shadow-blue-200 transition-all duration-300 flex items-center justify-center space-x-2 active:scale-[0.98]">
                        <span>Enter Dashboard</span>
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path></svg>
                    </button>
                </form>

                <div class="mt-12 text-center lg:text-left pt-6 border-t border-slate-100">
                    <p class="text-slate-400 text-xs font-medium">
                        System Security Verified &bull; &copy; {{ date('Y') }} Khalsa Agro
                    </p>
                </div>
            </div>
        </div>
    </div>

</body>
</html>