<div>
    <div class="container bg-white" dir="rtl">
        <div class="row">
            <div class="col-md-12 p-2">
                <img src="{{asset($setting->header) ?? asset('images/LLL.png')}}" width="100%" height="100px" alt="">
                <br>
                <br>
                <h3 class="text-center">{{__('public.contracts')}}</h3>
            </div>
            <div class="col-md-6">
                <table class="table table-bordered table-sm">
                    <tr>
                        <td class="bg-light">
                            {{__('public.receiptPrintDate')}}
                        </td>
                        <td class="text-center">
                            {{date('d-m-Y', strtotime($contract->created_at))}}
                        </td>
                    </tr>
                </table>
            </div>
            <div class="col-md-12">
                <div class="d-flex justify-content-between">
                    <span class="text-danger  fs-5">
                        حرر هذا العقد بين كل من
                    </span>
                    <span class="text-danger  fs-5">
                        This contract is maintained between
                    </span>
                </div>
            </div>
            <div class="col-md-6 mt-3">
                <table class="table table-bordered table-sm text-center align-middle">
                    <tr>
                        <td colspan="3" class="text-primary">
                            الطرف الأول ( صاحب العمل) - FIRST PARTY (Employer)
                        </td>
                    </tr>
                    <tr>
                        <td class="bg-light">
                            الاسم
                        </td>
                        <td>
                            {{$setting->companyNameAr}} / {{$setting->companyNameEn}}
                        </td>
                        <td class="bg-light">
                            Name
                        </td>
                    </tr>
                    <tr>
                        <td class="bg-light">
                            رقم السجل التجاري
                        </td>
                        <td>
                            {{$setting->CRNo}}
                        </td>
                        <td class="bg-light">
                            CR NO
                        </td>
                    </tr>
                    <tr>
                        <td class="bg-light">
                            العنوان
                        </td>
                        <td>
                            {{$setting->addressAr}} / {{$setting->addressEn}}
                        </td>
                        <td class="bg-light">
                            Address
                        </td>
                    </tr>
                    <tr>
                        <td class="bg-light">
                            المحافظة
                        </td>
                        <td>
                            {{$setting->governorateAr}} / {{$setting->governorateEn}}
                        </td>
                        <td class="bg-light">
                            Governorate
                        </td>
                    </tr>
                    <tr>
                        <td class="bg-light">
                            رقم المبنى
                        </td>
                        <td>
                            {{$setting->buildingNo}}
                        </td>
                        <td class="bg-light">
                            Building No
                        </td>
                    </tr>
                    <tr>
                        <td class="bg-light">
                            ص ب
                        </td>
                        <td>
                            {{$setting->POBox}}
                        </td>
                        <td class="bg-light">
                            P.O. Box
                        </td>
                    </tr>
                    <tr>
                        <td class="bg-light">
                            الرمز البريدي
                        </td>
                        <td>
                            {{$setting->pc}}
                        </td>
                        <td class="bg-light">
                            PC
                        </td>
                    </tr>
                    <tr>
                        <td class="bg-light">
                            البريد الإلكتروني
                        </td>
                        <td>
                            {{$setting->email}}
                        </td>
                        <td class="bg-light">
                            Email
                        </td>
                    </tr>
                </table>
            </div>
            <div class="col-md-6 mt-3">
                <table class="table table-bordered table-sm text-center align-middle">
                    <tr>
                        <td colspan="3" class="text-primary">
                            الطرف الثاني (العامل) - Second Party (Employee)
                        </td>
                    </tr>
                    <tr>
                        <td class="bg-light">
                            الرقم المدني
                        </td>
                        <td>
                            {{$employee->idNumber}}
                        </td>
                        <td class="bg-light">
                            Civil No
                        </td>
                    </tr>
                    <tr>
                        <td class="bg-light">
                            الاسم
                        </td>
                        <td>
                            {{$employee->employeeNameAr}}
                            <br>
                            {{$employee->employeeNameEn}}
                        </td>
                        <td class="bg-light">
                            Name
                        </td>
                    </tr>
                    <tr>
                        <td class="bg-light">
                            الجنسية
                        </td>
                        <td>
                            {{$employee->nationality}}
                        </td>
                        <td class="bg-light">
                            Nationality
                        </td>
                    </tr>
                    <tr>
                        <td class="bg-light">
                            تاريخ الميلاد
                        </td>
                        <td>
                            {{$employee->birthDate}}
                        </td>
                        <td class="bg-light">
                            Birth Date
                        </td>
                    </tr>
                    <tr>
                        <td class="bg-light">
                            المؤهل العلمي
                        </td>
                        <td>
                            {{$employee->academicQualification}}
                        </td>
                        <td class="bg-light">
                            Qualification
                        </td>
                    </tr>
                    <tr>
                        <td class="bg-light">
                            رقم جواز السفر
                        </td>
                        <td>
                            {{$employee->passportNumber}}
                        </td>
                        <td class="bg-light">
                            Passport Number
                        </td>
                    </tr>
                    <tr>
                        <td class="bg-light">
                            الصادر بتاريخ
                        </td>
                        <td>
                            {{$employee->passportDateOfIssue}}
                        </td>
                        <td class="bg-light">
                            Date of Issue
                        </td>
                    </tr>
                    <tr>
                        <td class="bg-light">
                            الصادر من
                        </td>
                        <td>
                            {{$employee->placeOfIssue}}
                        </td>
                        <td class="bg-light">
                            Issued By
                        </td>
                    </tr>
                    <tr>
                        <td class="bg-light">
                            رقم الهاتف
                        </td>
                        <td>
                            {{$employee->phone}}
                        </td>
                        <td class="bg-light">
                            Phone No
                        </td>
                    </tr>
                    <tr>
                        <td class="bg-light">
                            رقم الترخيص
                        </td>
                        <td>
                            ??
                        </td>
                        <td class="bg-light">
                            Clearance Number
                        </td>
                    </tr>
                    <tr>
                        <td class="bg-light">
                            رقم تصريح العمل
                        </td>
                        <td>
                            ??
                        </td>
                        <td class="bg-light">
                            WP Number
                        </td>
                    </tr>
                </table>
            </div>
            <div class="col-md-12 mt-3">
                <table class="table table-bordered table-sm align-middle">
                    <tr>
                        <td class="text-danger">
                            بعد ان أقرّ الطرفان بأهليتهما للتعاقد اتفقا على ما يلي
                        </td>
                        <td class="bg-light"></td>
                        <td class="text-end text-danger">
                            After declaring their illegibility to sign this contract

                            the two parties have agreed on the following
                        </td>
                    </tr>
                    <tr>
                        <td>
                            وافق الطرف الثاني أن يعمل لدى الطرف الأول بمهنة
                        </td>
                        <td class="bg-light text-center">
                            {{$contract->jobNameAr}}
                            <br>
                            {{$contract->jobNameEn}}
                        </td>
                        <td class="text-end">
                            The second party has agreed

                            to work with the first party as
                        </td>
                    </tr>
                    <tr>
                        <td>
                            مدة التعاقد
                        </td>
                        <td class="bg-light text-center">
                            {{$contract->contractDuration}}
                        </td>
                        <td class="text-end">
                            Duration of the contract
                        </td>
                    </tr>
                    <tr>
                        <td>
                            بداية العقد
                        </td>
                        <td class="bg-light text-center">
                            {{$contract->startDateContract}}
                        </td>
                        <td class="text-end">
                            From
                        </td>
                    </tr>
                    <tr>
                        <td>
                            نهاية العقد
                        </td>
                        <td class="bg-light text-center">
                            {{$contract->endDateContract}}
                        </td>
                        <td class="text-end">
                            To
                        </td>
                    </tr>
                    <tr>
                        <td>
                            الراتب الأساسي
                        </td>
                        <td class="bg-light text-center">
                            {{$contract->basicSalary}}
                        </td>
                        <td class="text-end">
                            Basic salary
                        </td>
                    </tr>
                    <tr>
                        <td>
                            الراتب الشامل
                        </td>
                        <td class="bg-light text-center">
                            {{$contract->totalSalary}}
                        </td>
                        <td class="text-end">
                            Gross salary
                        </td>
                    </tr>
                    <tr>
                        <td>
                            ويدفع الأجر لكل
                        </td>
                        <td class="bg-light text-center">
                            شهر
                            <br>
                            Monthly
                        </td>
                        <td class="text-end">
                            Pay Frequency
                        </td>
                    </tr>
                    <tr class="border border-0">
                        <td class="border border-0">
                            <h6>
                                الشروط والاحكام
                            </h6>
                            <p>
                                {{$contract->contractTermsAr}}
                            </p>
                        </td>
                        <td rowspan="2" class="border border-0">

                        </td>
                        <td class="text-end border border-0">
                            <h6>
                                Terms & Conditions
                            </h6>
                            <p>
                                {{$contract->contractTermsEn}}
                            </p>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="row justify-content-between">
            <div class="col-md-3 text-end">
                <div class="text-center">
                    <a id="printPageButton" href="javascript:window.print()" class="btn btn-dark m-2 m-2 waves-effect waves-light"><i class="fa fa-print"></i></a>
                </div>
            </div>
            <div class="col-md-3 text-end">
                <div class="text-center">
                    <p>{{__('public.stamp')}}</p>
                    <img src="{{ asset($setting->stamp) ?? asset('images/stampp.png')}}" width="125" height="125" alt="">
                </div>
            </div>
        </div>
    </div>
</div>
