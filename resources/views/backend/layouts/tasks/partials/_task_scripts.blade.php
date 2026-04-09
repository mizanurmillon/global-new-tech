<script>
// ===== CREATE MODAL =====
let createSkills = [];

function openCreateModal() {
    document.getElementById('createOverlay').style.display = 'block';
    const panel = document.getElementById('createPanel');
    panel.style.display = 'block';
    setTimeout(() => {
        panel.style.opacity = '1';
        panel.style.transform = 'translate(-50%,-50%) scale(1)';
    }, 10);
    document.body.style.overflow = 'hidden';
}

function closeCreateModal() {
    const panel = document.getElementById('createPanel');
    panel.style.opacity = '0';
    panel.style.transform = 'translate(-50%,-50%) scale(0.96)';
    setTimeout(() => {
        panel.style.display = 'none';
        document.getElementById('createOverlay').style.display = 'none';
        document.body.style.overflow = '';
    }, 250);
}

function addCreateSkill() {
    const input = document.getElementById('createSkillInput');
    const val   = input.value.trim();
    if (!val || createSkills.includes(val)) { input.value = ''; return; }
    createSkills.push(val);
    input.value = '';
    renderCreateTags();
}

function removeCreateSkill(skill) {
    createSkills = createSkills.filter(s => s !== skill);
    renderCreateTags();
}

function renderCreateTags() {
    const container = document.getElementById('createTagsContainer');
    container.innerHTML = '';
    createSkills.forEach(skill => {
        const tag = document.createElement('span');
        tag.style.cssText = 'display:inline-flex;align-items:center;gap:5px;padding:4px 10px;background:#f0f2f5;border-radius:20px;font-size:12px;font-weight:500;color:#333;';
        tag.innerHTML = `${skill} <span onclick="removeCreateSkill('${skill}')" style="cursor:pointer;color:#999;font-size:14px;line-height:1;">&times;</span>`;
        container.appendChild(tag);
    });
    document.getElementById('createSkillsHidden').value = JSON.stringify(createSkills);
}

// ===== TASK DETAIL PANEL =====
function openTaskPanel(d) {
    document.getElementById('tp-title').textContent    = d.title;
    document.getElementById('tp-type').textContent     = d.type;
    document.getElementById('tp-priority').textContent = d.priorityLabel;
    document.getElementById('tp-due').textContent      = d.due;
    document.getElementById('tp-assigned').textContent = d.assigned;
    document.getElementById('tp-created').textContent  = d.created;

    const badge       = document.getElementById('tp-badge');
    badge.textContent = d.statusLabel;
    badge.className   = 'task-badge badge-' + d.status;

    const statusProgress = {
        'pending':     { percent: 15,  color: '#3b82f6' },
        'in_progress': { percent: 50,  color: '#f59e0b' },
        'review':      { percent: 75,  color: '#8b5cf6' },
        'done':        { percent: 100, color: '#16a34a' },
    };
    const progress = statusProgress[d.status] || { percent: 0, color: '#ccc' };
    document.getElementById('tp-status-label').textContent = d.statusLabel;
    const bar = document.getElementById('tp-progress-bar');
    bar.style.width      = progress.percent + '%';
    bar.style.background = progress.color;

    const skillsContainer = document.getElementById('tp-skills');
    skillsContainer.innerHTML = '';
    if (d.skills && d.skills.trim()) {
        d.skills.split(',').forEach(skill => {
            skill = skill.trim();
            if (!skill) return;
            const tag = document.createElement('span');
            tag.style.cssText = 'display:inline-flex;align-items:center;padding:3px 10px;background:#f0f2f5;border-radius:20px;font-size:12px;font-weight:500;color:#444;';
            tag.textContent = skill;
            skillsContainer.appendChild(tag);
        });
    } else {
        skillsContainer.innerHTML = '<span style="color:#ccc;font-size:13px;">No skills added</span>';
    }

    document.getElementById('tp-description').textContent = d.description || 'No description provided.';
    document.getElementById('tp-note-input').value = d.note || '';
    document.getElementById('tp-note-success').style.display = 'none';

    document.getElementById('tp-statusForm').action = '/admin/tasks/' + d.id + '/status';
    const statusSel = document.getElementById('tp-statusForm').querySelector('select');
    for (let opt of statusSel.options) {
        opt.selected = (opt.value === d.status);
    }

    document.getElementById('tp-assignForm').action = d.assignUrl;
    const sel = document.getElementById('tp-assign-select');
    for (let opt of sel.options) {
        opt.selected = (opt.value === d.assignedId);
    }

    document.getElementById('tp-noteForm').action = d.noteUrl;

    document.getElementById('taskOverlay').style.display = 'block';
    const panel = document.getElementById('taskPanel');
    panel.style.display = 'block';
    setTimeout(() => {
        panel.style.opacity = '1';
        panel.style.transform = 'translate(-50%,-50%) scale(1)';
    }, 10);
    document.body.style.overflow = 'hidden';
}

function closeTaskPanel() {
    const panel = document.getElementById('taskPanel');
    panel.style.opacity = '0';
    panel.style.transform = 'translate(-50%,-50%) scale(0.96)';
    setTimeout(() => {
        panel.style.display = 'none';
        document.getElementById('taskOverlay').style.display = 'none';
        document.body.style.overflow = '';
    }, 250);
}

// ===== INIT =====
document.addEventListener('DOMContentLoaded', function () {

    document.querySelectorAll('.task-card').forEach(function (card) {
        card.addEventListener('click', function () {
            openTaskPanel(card.dataset);
        });
    });

    document.getElementById('createSkillInput').addEventListener('keydown', function (e) {
        if (e.key === 'Enter') { e.preventDefault(); addCreateSkill(); }
    });

    document.getElementById('tp-noteForm').addEventListener('submit', function (e) {
        e.preventDefault();
        const form    = this;
        const success = document.getElementById('tp-note-success');
        fetch(form.action, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json',
            },
            body: new FormData(form)
        })
        .then(res => res.json())
        .then(() => {
            success.style.display = 'inline';
            setTimeout(() => { success.style.display = 'none'; }, 3000);
        })
        .catch(() => alert('Failed to save note.'));
    });

    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') {
            closeTaskPanel();
            closeCreateModal();
        }
    });

});
</script>