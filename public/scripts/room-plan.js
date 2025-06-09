document.addEventListener('DOMContentLoaded', async () => {
    const path = window.location.pathname;
    const parts = path.split("/");
    const roomId = parts[2];
    const planInput = document.getElementById('plan-input');
    const addPlanBtn = document.getElementById('add-plan-btn');
    const planList = document.getElementById('plan-list');

    const res = await fetch(`/get-plans?roomId=${roomId}`);
    const result = await res.json();

    if (result.status === 'success') {
        result.plans.forEach(plan => {
            addPlanToList(plan.event_plan_item_id, plan.content);
        });
    } else {
        alert('Error loading plans');
    }

    addPlanBtn.addEventListener('click', async () => {
        const planText = planInput.value.trim();
        
        if (planText) {
           
            const res = await fetch('/add-plan-point', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ roomId: roomId, planText: planText })
            });

            const result = await res.json();

            if (result.status === 'success') {
                addPlanToList(result.planId, planText);
                planInput.value = ''; 
            } else {
                alert('Error adding plan');
            }
        }
    });

    function addPlanToList(planId, planText) {
        const planItem = document.createElement('li');
        planItem.setAttribute('data-id', planId);  

        const planContent = document.createElement('span');
        planContent.textContent = planText;

        const deleteBtn = document.createElement('button');
        deleteBtn.classList.add('delete-btn');
        deleteBtn.textContent = 'Delete';
        
        
        deleteBtn.addEventListener('click', async () => {

            const res = await fetch('/delete-plan-point', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ planId: planId })
            });

            const result = await res.json();

            if (result.status === 'success') {
                planItem.remove();
            } else {
                alert('Error deleting plan');
            }
        });

        planItem.appendChild(planContent);
        planItem.appendChild(deleteBtn);
        planList.appendChild(planItem);
    }
});
