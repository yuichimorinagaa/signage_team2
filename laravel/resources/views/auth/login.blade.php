<x-layout>
    <x-slot name="title">
        ログイン作成ページ
    </x-slot>
    @if ($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </div>
    @endif
    <div class="mt-5">
        <div class="container">
            <h3>
                ログインページ
            </h3>
            <form action="{{route('login.post')}}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="inputEmail" class="form-label">メールアドレス</label>
                    <input name="email" type="email" class="form-control" id="inputEmail" aria-describedby="emailHelp">
                </div>
                <div class="mb-3">
                    <label for="inputPassword" class="form-label">パスワード</label>
                    <input name="password" type="password" class="form-control" id="inputPassword">
                </div>
                <button type="submit" class="btn btn-primary">送信</button>
            </form>
        </div>
    </div>
</x-layout>
