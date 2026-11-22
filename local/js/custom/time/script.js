BX.addCustomEvent("onTimemanInit", function () {
    var savedEvent = null;
    var oldAction = null;
    var oldOpen = BXTIMEMAN.WND.ACTIONS.OPEN;
    var oldReopen = BXTIMEMAN.WND.ACTIONS.REOPEN;

    var popUpWindow = new BX.PopupWindow(
        'popup_timemanconfirm',
        null,
            {
                content: '<div style="padding: 10px">Начать рабочий день?</div>',
                closeIcon: {right: "20px", top: "10px"},
                width: 360,
                buttons: [
                    new BX.PopupWindowButton(
                        {
                            text: 'Подтвердить',
                            id: 'timeman-ok',
                            className: 'timeman-ok-button',
                            events: {
                                click: () => {
                                    popUpWindow.close();
                                    oldAction.call(BXTIMEMAN, savedEvent);
                                }
                            }
                        }
                    ),
                    new BX.PopupWindowButton(
                        {
                            text: 'Отмена',
                            id: 'timeman-deny',
                            className: 'timeman-deny-button',
                            events: {
                                click: () => {
                                    popUpWindow.close();
                                }
                            }
                        }
                    )
                ]
            }
    );

    BXTIMEMAN.WND.ACTIONS.OPEN = function (event) {
        savedEvent = event;
        oldAction = oldOpen;
        popUpWindow.show();
    };

    BXTIMEMAN.WND.ACTIONS.REOPEN = function (event) {
        savedEvent = event;
        oldAction = oldReopen;
        popUpWindow.show();
    };
});
