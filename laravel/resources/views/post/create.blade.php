<x-layout>
    <x-slot name="title">
        投稿作成ページ
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
            <form action="{{route('post.store')}}" method="post">
                @csrf
                {{--todo:csrfトークンについて理解--}}
                <div class="mb-3">
                    <label for="exampleInputName" class="form-label">投稿名</label>
                    <input type="text" class="form-control" id="exampleInputName" name="name">
                </div>
                <div class="mb-3">
                    <label for="exampleInputText" class="form-label">テキスト</label>
                    <input type="text" class="form-control" id="exampleInputText" aria-describedby="emailHelp" name="text">
                </div>
                <div class="mb-3">
                    <label for="exampleInputUser" class="form-label">ユーザーを選択する</label>
                    <select id="exampleInputUser" name="user_id">
                        @foreach($users as $user)
                            <option value="{{$user->id}}">{{$user->name}}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">登録</button>
            </form>
        </div>
    </div>
</x-layout>
