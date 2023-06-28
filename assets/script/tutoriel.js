const tour = new Shepherd.Tour({
    defaultStepOptions: {
        scrollTo: true,
        showCancelLink: true,
    },
});

// Ajoutez les étapes du tutoriel
tour.addStep({
    id: 'step1',
    attachTo: {
        element: '.element-1',
        on: 'right',
    },
    text: 'Bienvenue sur Estimmaüs ! Aline est la GOAT de tous les temps',
    buttons: [
        {
            text: 'Suivant',
            action: tour.next,
        },
    ],
});

tour.addStep({
    id: 'step2',
    attachTo: {
        element: '.element-2',
        on: 'left',
    },
    text: 'Réel masterclass ',
    buttons: [
        {
            text: 'Suivant',
            action: tour.next,
        },
    ],
});

// Ajoutez d'autres étapes du tutoriel selon vos besoins

// Démarrez le tutoriel
tour.start();
