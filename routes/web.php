<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\classcategoryController;
use App\Http\Controllers\admin\classsubjectController;
use App\Http\Controllers\admin\DepartmentController;
use App\Http\Controllers\admin\examcontroller;
use App\Http\Controllers\admin\FinallStudentController;
use App\Http\Controllers\admin\qestioncontroller;
use App\Http\Controllers\admin\SubjectController;
use App\Http\Controllers\admin\Uni_answer_qController;
use App\Http\Controllers\teacher\add_examController;
use App\Http\Controllers\teacher\ExamController as TeacherExamController;
use App\Http\Controllers\teacher\QestionController as TeacherQestionController;
use App\Http\Controllers\teacher\StudentController;
use App\Http\Controllers\teacher\TeacherController;
use App\Http\Controllers\user\UserController;
use App\Http\Controllers\VerifyotpController;
use App\Models\AddExam;
use App\Models\TeacherExam;

use function Pest\Laravel\get;

Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
})->name('forgot-password');




Route::middleware(['auth', 'role:admin'])->group(function () {

    Route::controller(AdminController::class)->group(function () {
        Route::get('/admin/dashboard', [AdminController::class, 'AdminDashboard'])->name('admin.dashboard');
        Route::get('/admin/logout', [AdminController::class, 'AdminLogout'])->name('admin.logout'); // optional
    });

    Route::controller(CategoryController::class)->group(function () {

        Route::get('all/category', 'AllCategory')->name('all.category');
        Route::get('/add/category', 'AddCategory')->name('add.category');
        Route::post('/store/category', 'StoreCategory')->name('store.category');
        Route::get('/edit/category/{id}', 'EditCategory')->name('edit.category');
        Route::post('/update/category/{id}', 'UpdateCategory')->name('update.category');
        Route::get('/delete/category/{id}', 'DeleteCategory')->name('delete.category');
    });

    Route::controller(Uni_answer_qController::class)->group(function () {

        Route::get('/all/answer', 'AllAnswer')->name('all.answer');
        Route::get('/add/answer', 'AddAnswer')->name('add.answer');
        Route::post('/store/answer', 'StoreAnswer')->name('store.answer');
        Route::get('/edit/answer/{id}', 'EditAnswer')->name('edit.answer');
        Route::post('/update/answer', 'UpdateAnswer')->name('update.answer');
        Route::get('/delete/answer/{id}', 'DeleteAnswer')->name('delete.answer');
    });

     Route::controller(FinallStudentController::class)->group(function () {
        Route::get('all/finall/student', 'AllFinallStudent')->name('all.finallStudent');
        // show all students
        Route::get('all/finall/student',  'AllFinallStudent')->name('all.finallStudent');
        // generate voucher
        // Route::get('generate/voucher/{user_id}', 'GenerateVoucher')->name('generate.voucher');
        // show voucher list for a student
        Route::get('show/voucher/{user_id}',  'ShowVoucher')->name('show.voucher');

        Route::post('/generate-voucher',  'createVoucher')->name('generate.voucher');

        Route::post('send-voucher/{voucher}',  'sendVoucher')->name('admin.send.voucher');

        // All Passed Students
        Route::get('/all/passed/students', 'AllPassedStudents')->name('all.passed.students');
        Route::get('/set/certificate/{id}', 'SetCertificate')->name('set.certificate');
        Route::post('/store/certificate/{id}', 'StoreCertificate')->name('store.certificate');
        Route::post('/update/certificate/{id}', 'UpdateCertificate')->name('update.certificate');
        Route::get('/certificate/delete/{id}','DeleteCertificate')->name('delete.certificate');
    });

    Route::controller(classsubjectController::class)->group(function() {
        Route::get('/all/subject' , 'AllSubject')->name('all.subject');
        Route::get('/add/subject' , 'AddSubject')->name('add.subject');
        Route::post('/store/subject' , 'StoreSubject')->name('store.subject');
        Route::get('/edit/subject/{id}' , 'EditSubject')->name('edit.subject');
        Route::post('/update/subject' , 'UpdateSubject')->name('update.subject');
        Route::get('/delete/subject/{id}' , 'DeleteSubject')->name('delete.subject');
    });

        Route::controller(classcategoryController::class)->group(function () {
        Route::get('/all/class/category', 'AllClassCategory')->name('all.class.category');
        Route::get('/add/class/category', 'AddClassCategory')->name('add.class.category');
        Route::post('/store/class/category', 'StoreClassCategory')->name('store.class.category');
        Route::get('/edit/class/category/{id}', 'EditClassCategory')->name('edit.class.category');
        Route::post('/update/class/category', 'UpdateClassCategory')->name('update.class.category');
        Route::get('/delete/class/category/{id}', 'DeleteClassCategory')->name('delete.class.category');
    });


    //start department
Route::controller(DepartmentController::class)->group(function () {
    Route::get('all/depart', 'AllDepart')->name('all.depart');
    Route::get('add/depart', 'AddDepart')->name('add.depart');
    Route::post('store/depart', 'StoreDepart')->name('store.depart');
    Route::get('edit/depart/{id}', 'EditDepart')->name('edit.depart');
    Route::post('depart/update/{id}', 'UpdateDepart')->name('update.depart');
    Route::get('delete/depart/{id}', 'DeleteDepart')->name('delete.depart');
});

Route::controller(examcontroller::class)->group(function () {
    Route::get('/all/exam', 'AllExam')->name('all.exam');
    Route::get('/add/exam', 'AddExam')->name('add.exam');
    Route::post('/store/exam', 'StoreExam')->name('store.exam');
    Route::get('/exam/edit/{id}', 'EditExam')->name('exam.edit');
    Route::post('/exam/update/', 'UpdateExam')->name('exam.update');
    Route::get('/exam/delete/{id}', 'DeleteExam')->name('exam.delete');
});

Route::get('/get-subjects/{department_id}', [SubjectController::class, 'getSubjectsByDepartment']);


Route::controller(qestioncontroller::class)->group(function() {
    Route::get('/all/qestion' , 'AllQestion')->name('all.qestion');
    Route::get('/add/qestion' , 'AddQestion')->name('add.qestion');
    Route::post('store/qestion' , 'StoreQestion')->name('store.qestion');
    Route::get('/edit/qestion/{id}' , 'EditQestion')->name('edit.qestion');
    Route::post('update/qestion' , 'UpdateQestion')->name('update.qestion');
    Route::get('/qestion/delete/{id}', 'DeleteQestion')->name('delete.qestion');
});

Route::controller(qestioncontroller::class)->group(function() {
    Route::get('/all/new/qestion' , 'AllNewQestion')->name('all.new.question');
    Route::get('/add/new/qestion' , 'AddNewQestion')->name('add.new.qestion');
    Route::post('store/new/qestion' , 'StoreNewQestion')->name('store.new.question');
    Route::get('/edit/new/qestion/{id}' , 'EditNewQestion')->name('edit.new.question');
    Route::post('/update/new/question/{id}','UpdateNewQestion')->name('update.new.question');
    Route::get('/new/qestion/delete/{id}', 'DeleteNewQestion')->name('delete.new.question');
});

    Route::controller(qestioncontroller::class)->group(function() {
        Route::get('/all/set/exam' , 'AllSetExam')->name('all.set.exam');
        Route::get('/add/set/exam' , 'AddSetExam')->name('add.set.exam');
        Route::post('store/set/exam' , 'StoreSetExam')->name('store.set.exam');
        Route::get('/edit/set/exam/{id}' , 'EditSetExam')->name('edit.set.exam');
        Route::post('/update/set/exam/{id}','UpdateSetExam')->name('update.set.exam');
        Route::get('/delete/set/exam/{id}', 'DeleteSetExam')->name('delete.set.exam');

        Route::get('/get-question/{subject_id}','getQuestion');
        Route::post('/assign-questions-to-exam', 'AssignQuestionsToExam')->name('assign.questions.exam');
    });

    Route::controller(classcategoryController::class)->group(function () {
        Route::get('/all/set/students', 'AllSetStudents')->name('all.set.students');
        Route::get('/set/teacher/{id}', 'SetTeacher')->name('set.teacher');
        Route::post('/update/set/teacher', 'UpdateSetTeacher')->name('update.set.teacher');
    });

});




Route::middleware(['auth', 'role:teacher'])->group(function () {
    Route::get('/teacher/dashboard', [TeacherController::class, 'TeacherDashboard'])->name('teacher.dashboard');
    Route::get('/teacher/logout', [TeacherController::class, 'TeacherLogout'])->name('teacher.logout');
     // optional


    Route::controller(TeacherQestionController::class)->group(function() {
        Route::get('/all/teacher/qestion' , 'AllTeacherQestion')->name('all.teacher.qestion');
        Route::get('/add/teacher/qestion' , 'AddTeacherQestion')->name('add.teacher.qestion');
        Route::post('store/teacher/qestion' , 'StoreTeacherQestion')->name('store.teacher.qestion');
        Route::get('/edit/teacher/qestion/{id}', 'EditTeacherQestion')->name('edit.teacher.qestion');
        Route::post('update/teacher/qestion' , 'UpdateTeacherQestion')->name('update.teacher.qestion');
        Route::get('/teacher/qestion/delete/{id}', 'DeleteTeacherQestion')->name('delete.teacher.qestion');
    });

       Route::controller(TeacherExamController::class)->group(function() {
        Route::get('/all/teacher/exam' , 'AllTeacherExam')->name('all.teacher.exam');
        Route::get('/add/teacher/exam' , 'AddTeacherExam')->name('add.teacher.exam');
        Route::post('store/teacher/exam' , 'StoreTeacherExam')->name('store.teacher.exam');
        Route::get('/edit/teacher/exam/{id}', 'EditTeacherExam')->name('edit.teacher.exam');
        Route::post('update/teacher/exam' , 'UpdateTeacherExam')->name('update.teacher.exam');
        Route::get('/teacher/qestion/exam/{id}', 'DeleteTeacherExam')->name('delete.teacher.exam');
    });

    Route::get('/get-teacher_subjects/{department_id}', [SubjectController::class, 'getSubjectsByDepartment']);

      Route::controller(StudentController::class)->group(function() {
        Route::get('/maange/student' , 'AllStudent')->name('manage.student');
        Route::get('/set/class/{id}' , 'SetClass')->name('set.class');
        Route::post('store/set/class' , 'StoreSetClass')->name('store.set.class');


    });

    Route::controller(add_examController::class)->group(function() {
        Route::get('/all/teacher/add/exam' , 'AllAddExam')->name('all.add.exam');
        Route::get('/add/teacher/add/exam' , 'AddExam')->name('add.teacher.add.exam');
        Route::post('store/teacher/add/exam' , 'StoreAddExam')->name('store.teacher.add.exam');
        Route::get('/edit/teacher/add/exam/{id}' , 'EditAddExam')->name('edit.teacher.add.exam');
        Route::post('update/teacher/add/exam' , 'UpdateAddExam')->name('update.teacher.add.exam');
        Route::get('/teacher/add/exam/delete/{id}', 'DeleteAddExam')->name('delete.teacher.add.exam');
     

    });

    Route::controller(add_examController::class)->group(function() {
        Route::get('/all/teacher/new/question' , 'AllTeacherNewQuestion')->name('all.teacher.new.question');
        Route::get('/add/teacher/new/question' , 'AddTeacherNewQuestion')->name('add.teacher.new.question');
        Route::post('store/teacher/new/question' , 'StoreTeacherNewQuestion')->name('store.teacher.new.question');
        Route::get('/edit/teacher/new/question/{id}' , 'EditTeacherNewQuestion')->name('edit.teacher.new.question');
        Route::post('update/teacher/new/question/{id}' , 'UpdateTeacherNewQuestion')->name('update.teacher.new.question');
        Route::get('all/teacher/delete/question/{id}', 'DeleteTeacherNewQuestion')->name('delete.teacher.new.question');
    });

    Route::controller(add_examController::class)->group(function() {
        Route::get('/all/teacher/set/exam' , 'AllTeacherSetExam')->name('all.teacher.set.exam');
        Route::get('/add/teacher/set/exam' , 'AddTeacherSetExam')->name('add.teacher.set.exam');
        Route::post('store/teacher/set/exam' , 'StoreTeacherSetExam')->name('store.teacher.set.exam');
        Route::get('/edit/teacher/set/exam/{id}' , 'EditTeacherSetExam')->name('edit.teacher.set.exam');
        Route::post('/update/teacher/set/exam/{id}','UpdateTeacherSetExam')->name('update.teacher.set.exam');
        Route::get('/delete/teacher/set/exam/{id}', 'DeleteTeacherSetExam')->name('delete.teacher.set.exam');

        Route::get('/get-questions/{subject_id}','getQuestions');
        Route::post('/assign-questions-to-exam', 'AssignQuestionsToExam')->name('assign.questions.exam');


    });

});



Route::get('/verify-account', [VerifyotpController::class, 'verifyaccount'])->name('verify.account');
Route::post('/verify-otp', [VerifyotpController::class, 'verifyotp'])->name('verify.otp');
Route::post('/resend-otp', [VerifyotpController::class, 'resend'])->name('resend.otp');

//  user routs group  start
Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/user/dashboard', [UserController::class, 'UserDashboard'])->name('user.dashboard');
    Route::get('/user/logout', [UserController::class, 'UserLogout'])->name('user.logout');
    Route::get('/user/finalexamdash', [UserController::class, 'UserFinalexamdash'])->name('user.finalexamdash');
    Route::get('/user/uprofile/userprofile', [UserController::class, 'UserProfile'])->name('user.uprofile.userprofile');
    Route::get('/user/uprofile/usereditprofile', [UserController::class, 'UserEditprofile'])->name('user.uprofile.usereditprofile');
    Route::post('/user/uprofile/update', [UserController::class, 'UserProfileUpdate'])->name('user.uprofile.update');
    Route::post('/user/select-teacher', [App\Http\Controllers\user\UserController::class, 'selectTeacher'])
     ->name('user.selectTeacher');
    Route::get('/user/uprofile/change-password', [UserController::class, 'UserChangepassword'])->name('user.uprofile.change-password');

    Route::post('/user/uprofile/update-password', [UserController::class, 'UserPasswordUpdate'])->name('user.uprofile.updatepassword');

    Route::get('/user/uni/unicode', [UserController::class, 'UserUnicode'])->name('user.unicode');

    // Route::get('/user/uni/uniexam/{id}', [UserController::class, 'UserUniexam'])->name('user.uniexam');
   Route::get('/user/uni/uniexam/{id}', [UserController::class, 'UserUniexam'])
    ->name('user.uniexam')
    ->middleware(['auth', 'check.voucher']);


    Route::post('/user/varifycode', [UserController::class, 'UserVarifyCode'])->name('user.varifycode');

    Route::post('submit/exam', [UserController::class, 'SubmitExam'])->name('exam.submit');
    Route::get('/user/examresult', [UserController::class, 'UserExamResult'])->name('user.examresult');
    Route::get('/user/certificate', [UserController::class, 'UserCertificate'])->name('user.certificate');
    // User Certificate
    Route::get('/user/get/certificate', [UserController::class, 'UserGetCertificate'])->name('user.get.certificate');


    //loginwithvoucher
    // Route::post('/voucher-login', [UserController::class, 'loginWithVoucher'])->name('voucher.login');

    // Mock Exam

    Route::controller(UserController::class)->group(function() {
        Route::get('/mock/exam' , 'MockExam')->name('mock.exam');
        Route::get('/list/exam/{id}' , 'ListExam')->name('list.exam');
        Route::get('/mock/exam/start/{id}' , 'MockExamStart')->name('mock.exam.start');
        Route::post('/mock/exam/submit/{id}' , 'MockExamSubmit')->name('mock.exam.submit');
        Route::get('/mock/exam/results/{exam}',  'examResults')->name('mock.exam.results');
    });
});




/**
 * After login, send users to their role dashboard automatically:
 */
Route::get('/dashboard', function () {
    $user = auth()->user();
    return match ($user?->role) {
        'admin'   => redirect()->route('admin.dashboard'),
        'teacher' => redirect()->route('teacher.dashboard'),
        default   => redirect()->route('user.dashboard'),
    };
})->middleware(['auth', 'verified'])->name('dashboard');


Route::get('/', function () {
    return view('auth.login');
});



require __DIR__ . '/auth.php';



// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });