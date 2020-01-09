@extends('layouts.app', ['page' => __('Post Management'), 'pageSlug' => 'posts'])

@section('content')
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('Post Management') }}</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('post.index') }}" class="btn btn-sm btn-primary">{{ __('Back to list') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('post.update', $post) }}" autocomplete="off">
                            @csrf
                            @method('put')

                            <h6 class="heading-small text-muted mb-4">{{ __('Post information') }}</h6>
                            <div class="pl-lg-4">
                                <div class="form-group{{ $errors->has('channel_id') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-channel-id">{{ __('Channels') }}</label>
                                    <select name="channel_id" class="form-control form-control-alternative{{ $errors->has('channel_id') ? ' is-invalid' : '' }}"
                                            id="input-channel-id">
                                        @foreach($channels as $channel)
                                            <option value="{{$channel->id}}" @if($channel->id === $post->channel_id) selected @endif >
                                                {{$channel->name}}
                                            </option>
                                        @endforeach
                                    </select>
                                    @include('alerts.feedback', ['field' => 'channel_id'])
                                </div>
                                <div class="form-group{{ $errors->has('category_id') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-category-id">{{ __('Categories') }} *</label>
                                    <select name="category_id[]" multiple required
                                            class="form-control form-control-alternative{{ $errors->has('category_id') ? ' is-invalid' : '' }}"
                                            id="input-category-id">
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}" @if(in_array($category->id,  explode(',', $post->category_id))) selected @endif >{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                    @include('alerts.feedback', ['field' => 'category_id'])
                                </div>
                                <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-name">{{ __('Name') }} *</label>
                                    <input type="text" name="name" id="input-name"
                                           class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                           placeholder="{{ __('Name') }}" value="{{ old('name', $post->name) }}" required autofocus>
                                    @include('alerts.feedback', ['field' => 'name'])
                                </div>
                                <div class="form-group{{ $errors->has('published_date') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-published-date">{{ __('Published Date') }} *</label>
                                    <input type="text" name="published_date" id="input-published-date" required
                                           class="form-control form-control-date form-control-alternative{{ $errors->has('published_date') ? ' is-invalid' : '' }}"
                                           placeholder="{{ __('Published') }}" value="{{ old('published_date', $post->published_date) }}" />
                                    @include('alerts.feedback', ['field' => 'published_date'])
                                </div>
                                <div class="form-group{{ $errors->has('link') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-link">{{ __('Link') }}</label>
                                    <input type="text" name="link" id="input-link"
                                           class="form-control form-control-alternative{{ $errors->has('link') ? ' is-invalid' : '' }}"
                                           placeholder="{{ __('Link') }}" value="{{ old('link', $post->link) }}" />
                                    @include('alerts.feedback', ['field' => 'link'])
                                </div>
                                <div class="form-group{{ $errors->has('guid') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-guid">{{ __('Guid') }}</label>
                                    <input type="text" name="guid" id="input-guid"
                                           class="form-control form-control-alternative{{ $errors->has('guid') ? ' is-invalid' : '' }}"
                                           placeholder="{{ __('Guid') }}" value="{{ old('guid', $post->guid) }}" />
                                    @include('alerts.feedback', ['field' => 'guid'])
                                </div>

                                <div class="form-group{{ $errors->has('comments') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-comments">{{ __('Comments') }}</label>
                                    <input type="text" name="comments" id="input-comments"
                                           class="form-control form-control-alternative{{ $errors->has('comments') ? ' is-invalid' : '' }}"
                                           placeholder="{{ __('Comments') }}" value="{{ old('comments', $post->comments) }}" />
                                    @include('alerts.feedback', ['field' => 'comments'])
                                </div>
                                <div class="form-group{{ $errors->has('description') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-description">{{ __('Description') }}</label>
                                    <textarea name="description" id="textarea-description" rows="3"
                                              class="form-control form-control-alternative{{ $errors->has('description') ? ' is-invalid' : '' }}"
                                              placeholder="{{ __('Description') }}">{{ old('description', $post->description) }}</textarea>
                                    @include('alerts.feedback', ['field' => 'description'])
                                </div>
                                <div class="form-check {{ $errors->has('is_permalink') ? ' has-danger' : '' }}">
                                    <label class="form-check-label">
                                        <input name="is_permalink"
                                               class="form-check-input"
                                               type="checkbox"
                                               value="1"
                                               @if($post->is_permalink) checked @endif >
                                        {{ __('Is permalink') }}
                                        <span class="form-check-sign">
                                            <span class="check"></span>
                                        </span>
                                    </label>
                                    @include('alerts.feedback', ['field' => 'is_permalink'])
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-success mt-4">{{ __('Save') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
