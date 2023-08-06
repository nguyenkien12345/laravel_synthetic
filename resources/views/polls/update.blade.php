@extends('layouts.home')

@section('content')
<div class="container">
    <div class="row">
        <h2 class="center">Update Poll: {{$poll->title}}</h2>

        <form class="col s12 m12 xl12" method="post" action="{{route('poll.update', [$poll])}}">
            @method('PUT')
            @csrf
            <div class="row">

                <div class="input-field col s12 m12 xl12">
                    <input required="required" name="title" id="title" type="text" class="validate"
                        value="{{$poll->title}}">
                    <label for="title">Title</label>
                </div>

                <div class="input-field col s12 m12 xl12">
                    <input required="required" name="start_date" id="startDate" type="text" class="datepicker"
                        value="{{$poll->start_date}}">
                    <label for="startDate">Start date</label>
                </div>

                <div class="input-field col s12 m12 xl12">
                    <input required="required" name="start_time" id="startTime" type="text" class="timepicker"
                        value="{{$poll->start_time}}">
                    <label for="startTime">Start time</label>
                </div>

                <div class="input-field col s12 m12 xl12">
                    <input required="required" name="end_date" id="endDate" type="text" class="datepicker"
                        value="{{$poll->end_date}}">
                    <label for="endDate">End date</label>
                </div>

                <div class="input-field col s12 m12 xl12">
                    <input required="required" name="end_time" id="endTime" type="text" class="timepicker"
                        value="{{$poll->end_time}}">
                    <label for="endTime">End time</label>
                </div>

                @php $answer=[1,2,3,4]; @endphp

                <div class="row col s12 m12 xl12" x-data="{
                    optionsNumber: {{count($poll->options)}},
                    options: {{json_encode($poll->options)}},
                    removeOption(id){
                        if(this.optionsNumber === 2){
                            alert('Each poll must has at least 2 options');
                            return;
                        }
                        this.options = this.options.filter(function(option){
                            return option.id !== id;
                        });
                        this.optionsNumber = this.options.length;
                    },
                    addOption(){
                        this.options.push({ id: Math.random() });
                        this.optionsNumber = this.options.length;
                    }
                }">
                    <h4>Options</h4>

                    <template x-for="option,index in options">
                        <div class="row">
                            <div class="col s12 m12 xl12">
                                <input required="required" name="options[][content]" id="content" type="text"
                                    class="validate" :placeholder="`Option ` + (index+1)" :value="option.content">
                            </div>
                            <div class="col s12 m12 xl12">
                                {{-- Gọi đến method removeOption() --}}
                                <button x-on:click="removeOption(option.id)"
                                    class="waves-effect waves-light btn red darken-4" type="button">
                                    REMOVE
                                </button>
                            </div>
                        </div>
                    </template>

                    <button x-on:click="addOption()" class="waves-effect waves-light btn info darken-2 center"
                        type="button">Add option
                    </button>

                    <hr>

                    <button class="waves-effect waves-light btn cyan darken-2 center" type="submit">Create</button>
                </div>

            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var dates = document.querySelectorAll('.datepicker');
        var instances = M.Datepicker.init(dates);
        var tiems = document.querySelectorAll('.timepicker');
        var instances = M.Timepicker.init(tiems);
      });
</script>
@endsection
