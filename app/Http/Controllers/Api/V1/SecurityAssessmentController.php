<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\SecurityAssessment\SecurityAssessmentRequest;
use App\Models\SecurityAssessment;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class SecurityAssessmentController extends Controller
{
    use ApiResponse;

    public function store(SecurityAssessmentRequest $request)
    {
        $data = $request->validated();

        $securityAssessment = SecurityAssessment::create($data);

        return $this->success($securityAssessment, "Security assessment request created successfully.", 201);
    }
}
