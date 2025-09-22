<?php

use Illuminate\Support\Facades\Schedule;

Schedule::command('livewire:configure-s3-upload-cleanup')->daily();
