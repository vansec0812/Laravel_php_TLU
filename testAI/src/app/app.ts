import { Component, signal, computed, effect, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';

interface Student {
  id: string;
  code: string;
  fullName: string;
  birthDate: string;
  gender: 'Nam' | 'Nữ' | 'Khác';
  type: 'Sinh viên' | 'Học sinh';
  school: string;
  address: string;
  phone: string;
  email: string;
  status: 'Thường trú' | 'Tạm trú';
  createdAt: string;
}

interface TodoTask {
  id: string;
  title: string;
  studentId: string; // empty string if none
  category: 'Xác minh' | 'Hỗ trợ' | 'Khảo sát' | 'Kiểm tra' | 'Khác';
  priority: 'Cao' | 'Trung bình' | 'Thấp';
  dueDate: string;
  completed: boolean;
  createdAt: string;
}

interface Toast {
  id: string;
  type: 'success' | 'danger' | 'warning';
  title: string;
  message: string;
}

@Component({
  selector: 'app-root',
  standalone: true,
  imports: [CommonModule, FormsModule],
  templateUrl: './app.component.html',
  styles: []
})
export class App implements OnInit {
  // Navigation & Theme
  activeTab = signal<'dashboard' | 'students' | 'todo'>('dashboard');
  theme = signal<'light' | 'dark'>('dark');
  mobileSidebarActive = signal<boolean>(false);
  currentDate = signal<string>('');

  // Search & Filters
  searchQuery = signal<string>('');
  filterType = signal<string>('all');
  filterStatus = signal<string>('all');
  filterGender = signal<string>('all');

  // Todo Filters
  todoFilter = signal<'all' | 'active' | 'completed'>('all');
  todoCategoryFilter = signal<string>('all');

  // State lists
  students = signal<Student[]>([]);
  tasks = signal<TodoTask[]>([]);
  toasts = signal<Toast[]>([]);

  // Modals & Forms
  isStudentModalOpen = signal<boolean>(false);
  isTodoModalOpen = signal<boolean>(false);
  isDeleteConfirmModalOpen = signal<boolean>(false);
  
  // Active editing targets
  currentEditingStudent = signal<Student | null>(null);
  currentEditingTask = signal<TodoTask | null>(null);

  // Deletion targets
  deleteType = signal<'student' | 'task'>('student');
  idToDelete = signal<string>('');
  nameToDelete = signal<string>('');

  // Form Models
  studentForm = {
    code: '',
    fullName: '',
    birthDate: '',
    gender: 'Nam' as 'Nam' | 'Nữ' | 'Khác',
    type: 'Sinh viên' as 'Sinh viên' | 'Học sinh',
    school: '',
    address: '',
    phone: '',
    email: '',
    status: 'Thường trú' as 'Thường trú' | 'Tạm trú'
  };

  todoForm = {
    title: '',
    studentId: '',
    category: 'Xác minh' as 'Xác minh' | 'Hỗ trợ' | 'Khảo sát' | 'Kiểm tra' | 'Khác',
    priority: 'Trung bình' as 'Cao' | 'Trung bình' | 'Thấp',
    dueDate: ''
  };

  // Seed Data (Fallbacks if localStorage is empty)
  private readonly defaultStudents: Student[] = [
    {
      id: 'st-1',
      code: 'SV2023412',
      fullName: 'Nguyễn Minh Anh',
      birthDate: '2005-08-15',
      gender: 'Nam',
      type: 'Sinh viên',
      school: 'Đại học Bách Khoa Hà Nội',
      address: 'Phòng 302, Tập thể C1 Kim Liên',
      phone: '0912345678',
      email: 'minhanh.nguyen@sis.hust.edu.vn',
      status: 'Thường trú',
      createdAt: new Date().toISOString()
    },
    {
      id: 'st-2',
      code: 'SV2022105',
      fullName: 'Trần Thị Phương Thảo',
      birthDate: '2004-11-20',
      gender: 'Nữ',
      type: 'Sinh viên',
      school: 'Đại học Y Hà Nội',
      address: 'Số 12, Ngõ 95 Lương Định Của',
      phone: '0987654321',
      email: 'phuongthao.tran@hmu.edu.vn',
      status: 'Tạm trú',
      createdAt: new Date().toISOString()
    },
    {
      id: 'st-3',
      code: 'HS2024098',
      fullName: 'Lê Hoàng Long',
      birthDate: '2008-04-12',
      gender: 'Nam',
      type: 'Học sinh',
      school: 'THPT Kim Liên',
      address: 'Số 88, Phố Phạm Ngọc Thạch',
      phone: '0904123456',
      email: 'longlh.hs@thptkimlien.edu.vn',
      status: 'Thường trú',
      createdAt: new Date().toISOString()
    },
    {
      id: 'st-4',
      code: 'SV2021650',
      fullName: 'Phạm Minh Đức',
      birthDate: '2003-02-28',
      gender: 'Nam',
      type: 'Sinh viên',
      school: 'Đại học Ngoại Thương',
      address: 'Số 15, Ngách 26/10 Chùa Bộc',
      phone: '0977889900',
      email: 'minhduc.pham@ftu.edu.vn',
      status: 'Tạm trú',
      createdAt: new Date().toISOString()
    },
    {
      id: 'st-5',
      code: 'HS2025112',
      fullName: 'Vũ Khánh Linh',
      birthDate: '2011-09-05',
      gender: 'Nữ',
      type: 'Học sinh',
      school: 'THCS Kim Liên',
      address: 'Phòng 105, Tập thể B10 Kim Liên',
      phone: '0945678901',
      email: 'linhvk.hs@thcskimlien.edu.vn',
      status: 'Thường trú',
      createdAt: new Date().toISOString()
    }
  ];

  private readonly defaultTasks: TodoTask[] = [
    {
      id: 'tk-1',
      title: 'Xác minh hồ sơ tạm trú Học kỳ II',
      studentId: 'st-2', // Trần Thị Phương Thảo
      category: 'Xác minh',
      priority: 'Cao',
      dueDate: new Date(Date.now() + 3 * 24 * 60 * 60 * 1000).toISOString().split('T')[0], // 3 days from now
      completed: false,
      createdAt: new Date().toISOString()
    },
    {
      id: 'tk-2',
      title: 'Phát học bổng khuyến học của UBND Phường',
      studentId: 'st-5', // Vũ Khánh Linh
      category: 'Hỗ trợ',
      priority: 'Trung bình',
      dueDate: new Date(Date.now() + 5 * 24 * 60 * 60 * 1000).toISOString().split('T')[0],
      completed: true,
      createdAt: new Date().toISOString()
    },
    {
      id: 'tk-3',
      title: 'Khảo sát tình hình cư trú khu tập thể C1',
      studentId: '',
      category: 'Khảo sát',
      priority: 'Thấp',
      dueDate: new Date(Date.now() + 10 * 24 * 60 * 60 * 1000).toISOString().split('T')[0],
      completed: false,
      createdAt: new Date().toISOString()
    },
    {
      id: 'tk-4',
      title: 'Kiểm tra hồ sơ nghĩa vụ quân sự sinh viên nam',
      studentId: 'st-4', // Phạm Minh Đức
      category: 'Kiểm tra',
      priority: 'Cao',
      dueDate: new Date(Date.now() + 2 * 24 * 60 * 60 * 1000).toISOString().split('T')[0],
      completed: false,
      createdAt: new Date().toISOString()
    }
  ];

  constructor() {
    // Write effect to save to LocalStorage automatically when states change
    effect(() => {
      localStorage.setItem('kimlien_students', JSON.stringify(this.students()));
    });

    effect(() => {
      localStorage.setItem('kimlien_tasks', JSON.stringify(this.tasks()));
    });
  }

  ngOnInit() {
    // Set time/date
    const options: Intl.DateTimeFormatOptions = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
    this.currentDate.set(new Date().toLocaleDateString('vi-VN', options));

    // Load theme
    const savedTheme = localStorage.getItem('theme') as 'light' | 'dark' || 'dark';
    this.theme.set(savedTheme);
    document.documentElement.setAttribute('data-theme', savedTheme);

    // Load data from LocalStorage or fall back
    const localStudents = localStorage.getItem('kimlien_students');
    if (localStudents) {
      try {
        this.students.set(JSON.parse(localStudents));
      } catch (e) {
        this.students.set(this.defaultStudents);
      }
    } else {
      this.students.set(this.defaultStudents);
    }

    const localTasks = localStorage.getItem('kimlien_tasks');
    if (localTasks) {
      try {
        this.tasks.set(JSON.parse(localTasks));
      } catch (e) {
        this.tasks.set(this.defaultTasks);
      }
    } else {
      this.tasks.set(this.defaultTasks);
    }
  }

  // Theme Toggler
  toggleTheme() {
    const newTheme = this.theme() === 'dark' ? 'light' : 'dark';
    this.theme.set(newTheme);
    document.documentElement.setAttribute('data-theme', newTheme);
    localStorage.setItem('theme', newTheme);
    this.showToast('success', 'Đổi Giao Diện', `Đã chuyển sang giao diện ${newTheme === 'dark' ? 'Tối' : 'Sáng'}!`);
  }

  // Toast System
  showToast(type: 'success' | 'danger' | 'warning', title: string, message: string) {
    const id = 'toast-' + Math.random().toString(36).substring(2, 9);
    const newToast: Toast = { id, type, title, message };
    this.toasts.update(current => [...current, newToast]);

    // Automatically remove after 3.5s
    setTimeout(() => {
      this.removeToast(id);
    }, 3500);
  }

  removeToast(id: string) {
    this.toasts.update(current => current.filter(t => t.id !== id));
  }

  // TAB NAVIGATION
  switchTab(tab: 'dashboard' | 'students' | 'todo') {
    this.activeTab.set(tab);
    this.mobileSidebarActive.set(false);
  }

  toggleMobileSidebar() {
    this.mobileSidebarActive.update(v => !v);
  }

  // COMPUTED PROPERTIES (DASHBOARD ANALYTICS)
  totalStudents = computed(() => this.students().length);
  
  totalCollegeStudents = computed(() => 
    this.students().filter(s => s.type === 'Sinh viên').length
  );
  
  totalSchoolPupils = computed(() => 
    this.students().filter(s => s.type === 'Học sinh').length
  );
  
  totalPermanent = computed(() => 
    this.students().filter(s => s.status === 'Thường trú').length
  );
  
  totalTemporary = computed(() => 
    this.students().filter(s => s.status === 'Tạm trú').length
  );

  totalTasks = computed(() => this.tasks().length);
  
  completedTasks = computed(() => 
    this.tasks().filter(t => t.completed).length
  );
  
  completedPercentage = computed(() => {
    const total = this.totalTasks();
    if (total === 0) return 0;
    return Math.round((this.completedTasks() / total) * 100);
  });

  collegePercentage = computed(() => {
    const total = this.totalStudents();
    if (total === 0) return 0;
    return Math.round((this.totalCollegeStudents() / total) * 100);
  });

  pupilsPercentage = computed(() => {
    const total = this.totalStudents();
    if (total === 0) return 0;
    return Math.round((this.totalSchoolPupils() / total) * 100);
  });

  temporaryPercentage = computed(() => {
    const total = this.totalStudents();
    if (total === 0) return 0;
    return Math.round((this.totalTemporary() / total) * 100);
  });

  // School lists statistics
  schoolStats = computed(() => {
    const map = new Map<string, number>();
    this.students().forEach(s => {
      const sch = s.school || 'Chưa cập nhật';
      map.set(sch, (map.get(sch) || 0) + 1);
    });
    
    return Array.from(map.entries())
      .map(([name, count]) => ({
        name,
        count,
        percentage: this.totalStudents() > 0 ? Math.round((count / this.totalStudents()) * 100) : 0
      }))
      .sort((a, b) => b.count - a.count);
  });

  // Recent actions / news
  recentStudents = computed(() => {
    return [...this.students()]
      .sort((a, b) => b.createdAt.localeCompare(a.createdAt))
      .slice(0, 4);
  });

  // FILTERED STUDENT LIST
  filteredStudents = computed(() => {
    const query = this.searchQuery().toLowerCase().trim();
    const type = this.filterType();
    const status = this.filterStatus();
    const gender = this.filterGender();

    return this.students().filter(s => {
      // Search Match
      const matchesSearch = !query || 
        s.fullName.toLowerCase().includes(query) ||
        s.code.toLowerCase().includes(query) ||
        s.school.toLowerCase().includes(query) ||
        s.address.toLowerCase().includes(query);

      // Filters Match
      const matchesType = type === 'all' || s.type === type;
      const matchesStatus = status === 'all' || s.status === status;
      const matchesGender = gender === 'all' || s.gender === gender;

      return matchesSearch && matchesType && matchesStatus && matchesGender;
    });
  });

  // FILTERED TASK LIST
  filteredTasks = computed(() => {
    const filter = this.todoFilter();
    const category = this.todoCategoryFilter();

    return this.tasks().filter(t => {
      const matchesFilter = 
        filter === 'all' ||
        (filter === 'active' && !t.completed) ||
        (filter === 'completed' && t.completed);

      const matchesCategory = category === 'all' || t.category === category;

      return matchesFilter && matchesCategory;
    });
  });

  // HELPER: Get Student name by ID
  getStudentName(studentId: string): string {
    if (!studentId) return 'Không có liên kết';
    const found = this.students().find(s => s.id === studentId);
    return found ? found.fullName : 'Học sinh/Sinh viên không tồn tại';
  }

  // CRUD STUDENT OPERATIONS
  openAddStudentModal() {
    this.currentEditingStudent.set(null);
    this.studentForm = {
      code: '',
      fullName: '',
      birthDate: '',
      gender: 'Nam',
      type: 'Sinh viên',
      school: '',
      address: '',
      phone: '',
      email: '',
      status: 'Thường trú'
    };
    this.isStudentModalOpen.set(true);
  }

  openEditStudentModal(student: Student) {
    this.currentEditingStudent.set(student);
    this.studentForm = {
      code: student.code,
      fullName: student.fullName,
      birthDate: student.birthDate,
      gender: student.gender,
      type: student.type,
      school: student.school,
      address: student.address,
      phone: student.phone,
      email: student.email,
      status: student.status
    };
    this.isStudentModalOpen.set(true);
  }

  closeStudentModal() {
    this.isStudentModalOpen.set(false);
  }

  saveStudent() {
    // Simple Validation
    if (!this.studentForm.code || !this.studentForm.fullName || !this.studentForm.school || !this.studentForm.address) {
      this.showToast('danger', 'Lỗi Nhập Liệu', 'Vui lòng điền đầy đủ các thông tin bắt buộc (*)!');
      return;
    }

    const editTarget = this.currentEditingStudent();
    
    // Check code duplication
    const duplicate = this.students().find(
      s => s.code.toLowerCase() === this.studentForm.code.toLowerCase() && (!editTarget || s.id !== editTarget.id)
    );
    if (duplicate) {
      this.showToast('danger', 'Trùng Mã Số', `Mã HS/SV [${this.studentForm.code}] đã tồn tại trong hệ thống!`);
      return;
    }

    if (editTarget) {
      // Edit mode
      this.students.update(list => 
        list.map(s => s.id === editTarget.id ? {
          ...s,
          code: this.studentForm.code,
          fullName: this.studentForm.fullName,
          birthDate: this.studentForm.birthDate,
          gender: this.studentForm.gender,
          type: this.studentForm.type,
          school: this.studentForm.school,
          address: this.studentForm.address,
          phone: this.studentForm.phone,
          email: this.studentForm.email,
          status: this.studentForm.status
        } : s)
      );
      this.showToast('success', 'Cập Nhật Thành Công', `Thông tin của ${this.studentForm.fullName} đã được chỉnh sửa.`);
    } else {
      // Add mode
      const newStudent: Student = {
        id: 'st-' + Math.random().toString(36).substring(2, 9),
        code: this.studentForm.code,
        fullName: this.studentForm.fullName,
        birthDate: this.studentForm.birthDate,
        gender: this.studentForm.gender,
        type: this.studentForm.type,
        school: this.studentForm.school,
        address: this.studentForm.address,
        phone: this.studentForm.phone,
        email: this.studentForm.email,
        status: this.studentForm.status,
        createdAt: new Date().toISOString()
      };
      this.students.update(list => [...list, newStudent]);
      this.showToast('success', 'Thêm Thành Công', `Đã thêm ${this.studentForm.type} ${this.studentForm.fullName} vào danh sách.`);
    }

    this.closeStudentModal();
  }

  // CUSTOM DELETE CONFIRMATION DIALOG
  requestDeleteStudent(student: Student) {
    this.deleteType.set('student');
    this.idToDelete.set(student.id);
    this.nameToDelete.set(student.fullName);
    this.isDeleteConfirmModalOpen.set(true);
  }

  requestDeleteTask(task: TodoTask) {
    this.deleteType.set('task');
    this.idToDelete.set(task.id);
    this.nameToDelete.set(task.title);
    this.isDeleteConfirmModalOpen.set(true);
  }

  closeDeleteConfirmModal() {
    this.isDeleteConfirmModalOpen.set(false);
  }

  confirmDelete() {
    const type = this.deleteType();
    const id = this.idToDelete();
    const name = this.nameToDelete();

    if (type === 'student') {
      // Delete student
      this.students.update(list => list.filter(s => s.id !== id));
      
      // Cascade delete student association in tasks (set studentId to empty)
      this.tasks.update(list => 
        list.map(t => t.studentId === id ? { ...t, studentId: '' } : t)
      );

      this.showToast('success', 'Xóa Thành Công', `Đã xóa học sinh/sinh viên ${name} khỏi hệ thống.`);
    } else {
      // Delete task
      this.tasks.update(list => list.filter(t => t.id !== id));
      this.showToast('success', 'Xóa Thành Công', `Đã xóa công việc [${name}].`);
    }

    this.closeDeleteConfirmModal();
  }

  // CRUD TODO OPERATIONS
  openAddTaskModal() {
    this.currentEditingTask.set(null);
    this.todoForm = {
      title: '',
      studentId: '',
      category: 'Xác minh',
      priority: 'Trung bình',
      dueDate: new Date().toISOString().split('T')[0]
    };
    this.isTodoModalOpen.set(true);
  }

  openEditTaskModal(task: TodoTask) {
    this.currentEditingTask.set(task);
    this.todoForm = {
      title: task.title,
      studentId: task.studentId,
      category: task.category,
      priority: task.priority,
      dueDate: task.dueDate
    };
    this.isTodoModalOpen.set(true);
  }

  closeTodoModal() {
    this.isTodoModalOpen.set(false);
  }

  saveTask() {
    if (!this.todoForm.title || !this.todoForm.dueDate) {
      this.showToast('danger', 'Lỗi Nhập Liệu', 'Vui lòng nhập tên công việc và hạn hoàn thành!');
      return;
    }

    const editTarget = this.currentEditingTask();

    if (editTarget) {
      // Edit
      this.tasks.update(list =>
        list.map(t => t.id === editTarget.id ? {
          ...t,
          title: this.todoForm.title,
          studentId: this.todoForm.studentId,
          category: this.todoForm.category,
          priority: this.todoForm.priority,
          dueDate: this.todoForm.dueDate
        } : t)
      );
      this.showToast('success', 'Cập Nhật Công Việc', `Công việc [${this.todoForm.title}] đã được chỉnh sửa.`);
    } else {
      // Add
      const newTask: TodoTask = {
        id: 'tk-' + Math.random().toString(36).substring(2, 9),
        title: this.todoForm.title,
        studentId: this.todoForm.studentId,
        category: this.todoForm.category,
        priority: this.todoForm.priority,
        dueDate: this.todoForm.dueDate,
        completed: false,
        createdAt: new Date().toISOString()
      };
      this.tasks.update(list => [...list, newTask]);
      this.showToast('success', 'Thêm Công Việc', `Đã tạo công việc mới: [${this.todoForm.title}].`);
    }

    this.closeTodoModal();
  }

  toggleTaskCompleted(task: TodoTask) {
    this.tasks.update(list =>
      list.map(t => t.id === task.id ? { ...t, completed: !t.completed } : t)
    );
    const updatedTask = this.tasks().find(t => t.id === task.id);
    if (updatedTask?.completed) {
      this.showToast('success', 'Hoàn Thành Công Việc', `Chúc mừng! Đã hoàn thành: [${task.title}].`);
    } else {
      this.showToast('warning', 'Mở Lại Công Việc', `Đã chuyển công việc về chưa hoàn thành: [${task.title}].`);
    }
  }

  // EXTRA FEAUTURE: EXPORT DATA
  exportToJSON() {
    const data = {
      phuong: 'Kim Liên - Đống Đa - Hà Nội',
      exportDate: new Date().toISOString(),
      total_students: this.students().length,
      students: this.students(),
      tasks: this.tasks()
    };
    const jsonString = `data:text/json;charset=utf-8,${encodeURIComponent(JSON.stringify(data, null, 2))}`;
    const downloadAnchor = document.createElement('a');
    downloadAnchor.setAttribute('href', jsonString);
    downloadAnchor.setAttribute('download', `bao_cao_quan_ly_sv_kimlien_${new Date().toISOString().split('T')[0]}.json`);
    document.body.appendChild(downloadAnchor);
    downloadAnchor.click();
    downloadAnchor.remove();

    this.showToast('success', 'Xuất Báo Cáo', 'Đã tải xuống file báo cáo định dạng JSON thành công.');
  }

  exportToCSV() {
    let csvContent = 'data:text/csv;charset=utf-8,\uFEFF'; // BOM for Excel encoding support
    csvContent += 'Mã Học Sinh/Sinh Viên,Họ và Tên,Ngày Sinh,Giới Tính,Phân Loại,Trường Học,Địa Chỉ,Số Điện Thoại,Email,Diện Cư Trú\n';
    
    this.students().forEach(s => {
      const row = [
        s.code,
        s.fullName,
        s.birthDate,
        s.gender,
        s.type,
        s.school,
        s.address.replace(/,/g, ';'), // avoid CSV column breaking
        s.phone,
        s.email,
        s.status
      ].join(',');
      csvContent += row + '\n';
    });

    const encodedUri = encodeURI(csvContent);
    const downloadAnchor = document.createElement('a');
    downloadAnchor.setAttribute('href', encodedUri);
    downloadAnchor.setAttribute('download', `danh_sach_hoc_sinh_sinh_vien_kimlien_${new Date().toISOString().split('T')[0]}.csv`);
    document.body.appendChild(downloadAnchor);
    downloadAnchor.click();
    downloadAnchor.remove();

    this.showToast('success', 'Xuất File Excel', 'Đã tải xuống danh sách định dạng CSV thành công.');
  }
}
