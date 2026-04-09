<script>
function openLeadPanel(d) {
    document.getElementById('p-name').textContent    = d.name;
    document.getElementById('p-company').textContent = d.company;

    const badge       = document.getElementById('p-badge');
    badge.textContent = d.statusLabel;
    badge.className   = 'lead-badge badge-' + d.status.replace(/_/g, '-');

    document.getElementById('p-email').textContent        = d.email;
    document.getElementById('p-phone').textContent        = d.phone;
    document.getElementById('p-interest').textContent     = d.interest;
    document.getElementById('p-company-size').textContent = d.companySize;
    document.getElementById('p-budget').textContent       = d.budget;
    document.getElementById('p-urgency').textContent      = d.urgency;

    const statusProgress = {
        'new':         { percent: 10,  color: '#3b82f6' },
        'contacted':   { percent: 25,  color: '#8b5cf6' },
        'qualified':   { percent: 45,  color: '#f59e0b' },
        'proposal':    { percent: 60,  color: '#f97316' },
        'negotiation': { percent: 80,  color: '#ef4444' },
        'closed_won':  { percent: 100, color: '#16a34a' },
        'closed_lost': { percent: 100, color: '#6b7280' },
    };

    const progress = statusProgress[d.status] || { percent: 0, color: '#ccc' };
    document.getElementById('p-score-label').textContent = d.statusLabel;
    const bar = document.getElementById('p-score-bar');
    bar.style.width      = progress.percent + '%';
    bar.style.background = progress.color;

    document.getElementById('p-message').textContent = d.message || 'No message provided.';
    document.getElementById('p-note-input').value    = d.note || '';
    document.getElementById('p-note-success').style.display = 'none';

    document.getElementById('p-statusForm').action = '/admin/leads/' + d.id + '/status';
    const statusSel = document.getElementById('p-status-select');
    for (let opt of statusSel.options) {
        opt.selected = (opt.value === d.status);
    }

    document.getElementById('p-assignForm').action = d.assignUrl;
    const sel = document.getElementById('p-assign-select');
    for (let opt of sel.options) {
        opt.selected = (opt.value === d.assignedId);
    }

    document.getElementById('p-noteForm').action = d.noteUrl;

    document.getElementById('leadOverlay').style.display = 'block';
    const panel = document.getElementById('leadPanel');
    panel.style.display = 'block';
    setTimeout(() => {
        panel.style.opacity = '1';
        panel.style.transform = 'translate(-50%, -50%) scale(1)';
    }, 10);
    document.body.style.overflow = 'hidden';
}

function closeLeadPanel() {
    const panel = document.getElementById('leadPanel');
    panel.style.opacity = '0';
    panel.style.transform = 'translate(-50%, -50%) scale(0.96)';
    setTimeout(() => {
        panel.style.display = 'none';
        document.getElementById('leadOverlay').style.display = 'none';
        document.body.style.overflow = '';
    }, 250);
}

document.addEventListener('DOMContentLoaded', function () {

    document.querySelectorAll('.lead-card').forEach(function (card) {
        card.addEventListener('click', function () {
            openLeadPanel(card.dataset);
        });
    });

    document.getElementById('p-noteForm').addEventListener('submit', function (e) {
        e.preventDefault();
        const form    = this;
        const success = document.getElementById('p-note-success');

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

            const noteValue = document.getElementById('p-note-input').value;
            const leadId    = form.action.split('/leads/')[1].split('/')[0];
            const card      = document.querySelector(`.lead-card[data-id="${leadId}"]`);
            if (card) card.dataset.note = noteValue;
        })
        .catch(() => alert('Failed to save note. Please try again.'));
    });

    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') closeLeadPanel();
    });

});
</script>