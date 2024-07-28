const openModalButtons = document.querySelectorAll('[data-modal-target]');
const closeButtons = document.querySelectorAll('.modal-close-button');
const modals = document.querySelectorAll('.modal');

// Функция для открытия модального окна
function openModal(modal) {
    modal.style.display = 'block';
}

// Функция для закрытия модального окна
function closeModal(modal) {
    modal.style.display = 'none';
}

// Обработчики событий для кнопок открытия и закрытия модальных окон
openModalButtons.forEach(button => {
    button.addEventListener('click', () => {
        const targetModalId = button.dataset.modalTarget;
        const targetModal = document.getElementById(targetModalId);
        openModal(targetModal);
    });
});

closeButtons.forEach(button => {
    button.addEventListener('click', () => {
        const modal = button.closest('.modal');
        closeModal(modal);
    });
});

window.addEventListener('click', (event) => {
    modals.forEach(modal => {
        if (event.target === modal) {
            closeModal(modal);
        }
    });
});
