@section('title', 'E-TRAK - Create ADMIN account')

@section('vite')
    @vite(['resources/css/app.css', 'resources/js/app.js']);
@endsection

<x-layout>
    <div class="flex items-center justify-center">
        <div class="w-full max-w-md p-8 space-y-6 bg-sky-300 rounded-2xl shadow-lg">
            <h2 class="text-2xl font-bold text-center text-gray-800">Create an ADMIN account</h2>
            @if ($errors->any())
                <ul class="px-3 py-2 bg-red-400 rounded-md">
                    @foreach ($errors->all() as $error)
                        <li class="text-md text-white">{{ $error }}</li>
                    @endforeach
                </ul>
            @endif
            <form action="{{ route('signup.admin') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <input type="text" name="name" 
                    class="w-full px-4 py-2 mt-1 text-gray-800 bg-gray-100 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" 
                    placeholder="Username" required autofocus />
                </div>
                <div>
                    <input type="email" name="email" 
                    class="w-full px-4 py-2 mt-1 text-gray-800 bg-gray-100 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" 
                    placeholder="E-mail" required />
                </div>
                <div>
                    <input type="password" name="password" 
                    class="w-full px-4 py-2 mt-1 text-gray-800 bg-gray-100 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" 
                    placeholder="Password" required />
                </div>
                <div>
                    <input type="password" name="password_confirmation" 
                    class="w-full px-4 py-2 mt-1 text-gray-800 bg-gray-100 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" 
                    placeholder="Confirm Password" required />
                </div>
                <div>
                    <input type="submit" name="signup" value="Sign Up" 
                    class="w-full px-4 py-2 font-semibold text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:ring-2 focus:ring-blue-500" />
                </div>
            </form>
            <div>
                <p class="text-sm text-center text-gray-700">
                    Return to <a href="{{ route('view.login') }}" class="text-blue-700 hover:underline">login</a> or <a href="{{ route('view.signup') }}" class="text-blue-700 hover:underline">sign up</a>.
                </p>
            </div>
        </div>
    </div>
</x-layout>