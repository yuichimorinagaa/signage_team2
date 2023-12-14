<x-layout>
    <x-slot name="title">
        投稿一覧
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
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>題名</th>
                        <th>内容</th>
                        <th>作者名</th>
                        <th>編集</th>
                        <th>削除</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($posts as $post)
                    <tr>
                        <td>{{$post->name}}</td>
                        <td>{{$post->text}}</td>
                        <td>{{$post->user->name}}</td>
                        <td><a href="{{route('post.edit',$post->id)}}"><button class="btn btn-success">編集</button></a></td>
                        <td>
                            <form action="{{route('post.delete',$post->id)}}" method="post">@csrf @method('DELETE')<button class="btn btn-danger">削除</button></form></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="text-center">
        <a href="{{route('post.create')}}"><button class="btn btn-primary">新規登録</button></a>
    </div>
</x-layout>
{{--todo:コンポーネントの理解--}}
