<div class="">
    <label for="remarks" class="mb-2">Remarks for
        <span id="remarkTitle">
            @if ($application->application_status == 6)
                on hold
            @endif

            @if ($application->application_status == 2)
                rejected
            @endif
        </span>
    </label>
    <p name="remarks" id="remarks" rows="6" class="form-control small-text-12 text-start"
        style="min-height: 200px" readonly>
        {{$application->remark}}
    </p>
</div>
