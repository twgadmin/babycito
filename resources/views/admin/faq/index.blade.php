@extends('admin.layouts.app')

@section('content')
<section id="column-selectors">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Faq's <i class="feather icon-globe"></i></h4>
                </div>
                <div class="card-content">
                    <div class="card-body card-dashboard">
                        <div class="table-responsive">
                            <table class="table table-striped dataex-html5-selectors">
                                <thead>
                                    <tr>
                                        <th>Question</th>
                                        <th>Answer</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                	@foreach ($data as $key => $faq)
	                                    <tr>
	                                        <td>@php
                                            

                                            
                                            
                                                $question = substr($faq->question,0,100);  
                                                $question = substr($question,0,strrpos($question,' '));
                                                $answer = substr($faq->answer,0,100);  
                                                $answer = substr($answer,0,strrpos($answer,' '));   
                                                $question = $question." <a href='faq/$faq->id'>Read More...</a>"; 
                                                $answer = $answer." <a href='faq/$faq->id'>Read More...</a>";
                                            
                                            @endphp
                                            
                                                {!! $question !!}</td>
	                                        <td>{!! $answer !!}</td>
	                                        <td>
	                                        	<a href="{!! route('admin.faq.show', $faq->id) !!}" class="btn btn-info btn-sm waves-effect waves-light">
                                                    <i class="feather icon-search"></i>
                                                </a>

	                                        	<a href="{!! route('admin.faq.edit', $faq->id) !!}" class="btn btn-primary btn-sm waves-effect waves-light">
                                                    <i class="feather icon-edit"></i>
                                                </a>

	                                        	<button type="button" onclick="deleteConfirmation({!! $faq->id !!})" class="btn btn-danger btn-sm waves-effect waves-light">
                                                    <i class="feather icon-trash"></i>
                                                </button>

                                                <form action="{!! URL::route('admin.faq.destroy', $faq->id) !!}" method="POST" id="deleteForm{!! $faq->id !!}">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
	                                        </td>
	                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                       	</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Column selectors with Export Options and print table -->
@endsection