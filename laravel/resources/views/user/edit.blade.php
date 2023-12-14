<x-layout>
    <x-slot name="title">
        ユーザー編集ページ
    </x-slot>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">CRUD-temp</a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{route('user.index')}}">ユーザー一覧へ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{route('post.index')}}">投稿一覧へ</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="mt-5">
        <div class="container">
            <form action="{{route('user.update',$user->id)}}" method="post">
                @csrf
                {{--todo:csrfトークンについて理解--}}
                <div class="mb-3">
                    <label for="exampleInputName" class="form-label">名前</label>
                    <input type="text" class="form-control" id="exampleInputName" name="name" value="{{$user->name}}">
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">メールアドレス</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email" value="{{$user->email}}">
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">パスワード</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" name="password" value="{{$user->password}}">
                </div>
                <button type="submit" class="btn btn-primary">更新</button>
            </form>
        </div>
    </div>
</x-layout>
