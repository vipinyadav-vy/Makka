@extends('admin.layouts.admin')
@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card card-white">
                    <div class="card-header">
                      <h3 class="card-title">Edit Project</h3>
                      <a href="{{ url()->previous() }}" class="btn btn-secondary float-right text-white">Back</a>
                    </div>
                    <form method="POST" action="{{route('user_projects.update',[$record->id])}}" enctype="multipart/form-data" autocomplete="off">
                    @method('PUT')
                    @csrf
                    <div class="card-body">
                        <div class="form-row form-set">
                            <div class="form-group col-12">
                                <label for="projectName">Project Name</label>
                                <input type="text" class="form-control" name="name" value="{{ old('name', $record->name) }}" id="projectName" autocomplete="off" placeholder="Enter Project Name" required>
                            </div>
                        </div>
                        <div class="form-row"><div class="form-group col-12"><hr></div></div>
                        <div class="form-row">
                            <div class="form-group col-12">
                                <h5 class="card-title font-weight-bold">Link Webforms for Project</h5>
                            </div>
                        </div>
                        <div class="form-row mb-4">
                            @foreach($webforms as $webformval)
                                @php
                                    $isChecked = in_array($webformval->id, $webformIds) ? 'checked' : '';
                                @endphp
                                <div class="form-group col-4 pl-4">
                                    <div class="form-check icheck-primary form-check-inline">
                                        <input name="webforms[]" {{$isChecked}} class="form-check-input project-checkbox" type="checkbox" id="webforms_{{ $webformval->id }}" value="{{ $webformval->id }}">
                                        <label class="form-check-label pl-2" for="webforms_{{ $webformval->id }}">{{ $webformval->title }}</label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="card-center float-left">
                            <button type="submit" class="btn btn-success">UPDATE</button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    const textAreaElement = document.querySelector("#exampleInputname");
    const characterCounterElement = document.querySelector("#character-counter");
    const typedCharactersElement = document.querySelector("#typed-characters");
    const maximumCharacters = 300;
    textAreaElement.addEventListener("keydown", (event) => {
        const typedCharacters = textAreaElement.value.length;
        if (typedCharacters > maximumCharacters) {
            return false;
        }
        typedCharactersElement.textContent = typedCharacters;
        if (typedCharacters >= 200 && typedCharacters < 250) {
            characterCounterElement.classList = "text-warning";
        } else if (typedCharacters >= 250) {
            characterCounterElement.classList = "text-danger";
        }
    });
</script>
<script>
const textAreaElement_a = document.querySelector("#exampleInputanswers_a");
const characterCounterElement_a = document.querySelector("#character-counter_a");
const typedCharactersElement_a = document.querySelector("#typed-characters_a");
const maximumCharacters_a = 200;
textAreaElement_a.addEventListener("keydown", (event) => {
    const typedCharacters_a = textAreaElement_a.value.length;
    if (typedCharacters_a > textAreaElement_a) {
        return false;
    }
    typedCharactersElement_a.textContent = typedCharacters_a;
    if (typedCharacters_a >= 200 && typedCharacters_a < 250) {
        characterCounterElement_a.classList = "text-warning";
    } else if (typedCharacters_a >= 250) {
        characterCounterElement_a.classList = "text-danger";
    }
});
</script>
<script>
const textAreaElement_b = document.querySelector("#exampleInputanswers_b");
const characterCounterElement_b = document.querySelector("#character-counter_b");
const typedCharactersElement_b = document.querySelector("#typed-characters_b");
const maximumCharacters_b = 200;
textAreaElement_b.addEventListener("keydown", (event) => {
    const typedCharacters_b = textAreaElement_b.value.length;
    if (typedCharacters_b > textAreaElement_b) {
        return false;
    }
    typedCharactersElement_b.textContent = typedCharacters_b;
    if (typedCharacters_b >= 200 && typedCharacters_b < 250) {
        characterCounterElement_b.classList = "text-warning";
    } else if (typedCharacters_b >= 250) {
        characterCounterElement_b.classList = "text-danger";
    }
});
</script>
<script>
const textAreaElement_c = document.querySelector("#exampleInputanswers_c");
const characterCounterElement_c = document.querySelector("#character-counter_c");
const typedCharactersElement_c = document.querySelector("#typed-characters_c");
const maximumCharacters_c = 200;
textAreaElement_c.addEventListener("keydown", (event) => {
    const typedCharacters_c = textAreaElement_c.value.length;
    if (typedCharacters_c > textAreaElement_c) {
        return false;
    }
    typedCharactersElement_c.textContent = typedCharacters_c;
    if (typedCharacters_c >= 200 && typedCharacters_c < 250) {
        characterCounterElement_c.classList = "text-warning";
    } else if (typedCharacters_c >= 250) {
        characterCounterElement_c.classList = "text-danger";
    }
});
</script>
<script>
const textAreaElement_d = document.querySelector("#exampleInanswers_d");
const characterCounterElement_d = document.querySelector("#character-counter_d");
const typedCharactersElement_d = document.querySelector("#typed-characters_d");
const maximumCharacters_d = 200;
textAreaElement_d.addEventListener("keydown", (event) => {
    const typedCharacters_d = textAreaElement_d.value.length;
    if (typedCharacters_d > textAreaElement_d) {
        return false;
    }
    typedCharactersElement_d.textContent = typedCharacters_d;
    if (typedCharacters_d >= 200 && typedCharacters_d < 250) {
        characterCounterElement_d.classList = "text-warning";
    } else if (typedCharacters_d >= 250) {
        characterCounterElement_d.classList = "text-danger";
    }
});
</script>
@endsection
