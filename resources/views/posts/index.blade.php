@extends('layouts.app', ['page' => __('Post Management'), 'pageSlug' => 'posts'])

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header">
                    <div class="row">
                        <div class="col-2 text-left">
                            <h4 class="card-title">{{ __('Posts') }}</h4>
                        </div>
                        <div class="col-4">
                            <form action="/post/index" onchange="this.submit();">
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="inputState">Categories</label>
                                        <select name="category" class="form-control">
                                            <option value=""> All categories </option>
                                            @foreach($optionCategories as $key => $value)
                                                <option value="{{$key}}" @if ($key == $cat_selected) selected @endif >{{$value}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="inputState">Number of items on page</label>
                                        <select name="per_page" class="form-control">
                                            <option value="5"  @if (5 == $per_page) selected @endif >5</option>
                                            <option value="10" @if (10 == $per_page) selected @endif >10</option>
                                            <option value="15" @if (15 == $per_page) selected @endif >15</option>
                                            <option value="20" @if (20 == $per_page) selected @endif >20</option>
                                        </select>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-6 text-right">
                            <a href="{{ route('post.create') }}" class="btn btn-sm btn-primary">{{ __('Add post') }}</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @include('alerts.success')

                    <div class="">
                        <table class="table tablesorter " id="">
                            <thead class=" text-primary">
                                <th scope="col">{{ __('Name') }}</th>
                                <th scope="col">{{ __('Published Date') }}</th>
                                <th scope="col">{{ __('Creation Date') }}</th>
                                <th scope="col"></th>
                            </thead>
                            <tbody>
                                @foreach ($posts as $item)
                                    <tr>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ (new \Carbon\Carbon($item->published_date))->format('d/m/Y H:i') }}</td>
                                        <td>{{ $item->created_at->format('d/m/Y H:i') }}</td>
                                        <td class="text-right">
                                                <div class="dropdown">
                                                    <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="fas fa-ellipsis-v"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                        @if (auth()->user()->id == $item->user_id)
                                                            <form action="{{ route('post.destroy', $item) }}" method="post">
                                                                @csrf
                                                                @method('delete')

                                                                <a class="dropdown-item" href="{{ route('post.edit', $item) }}">{{ __('Edit') }}</a>
                                                                <button type="button" class="dropdown-item"
                                                                        onclick="confirm('{{ __("Are you sure you want to delete this post?") }}') ? this.parentElement.submit() : ''">
                                                                            {{ __('Delete') }}
                                                                </button>
                                                            </form>
                                                        @else
                                                            <a class="dropdown-item" href="{{ route('post.edit', $item) }}">{{ __('Edit') }}</a>
                                                        @endif
                                                    </div>
                                                </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer py-4">
                    <nav class="d-flex justify-content-end" aria-label="...">
                        {{ $posts->links() }}
                    </nav>
                </div>
            </div>
        </div>
    </div>
@endsection
