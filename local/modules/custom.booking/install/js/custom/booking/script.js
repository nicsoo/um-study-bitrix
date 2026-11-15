function bookingPopupOpen(procedureId, procedureName) {
        var myPopup = new BX.PopupWindow(
            'my_unique_popup_id' + procedureId,
            null,
            {
                content: '<div style="padding:16px">'
                + '<div>Имя<br><input type="text" id="booking-patient"></div>'
                + '<div>Дата<br><input type="text" id="booking-date"></div>'
                + '</div>',
                closeIcon: {right: "20px", top: "10px"},
                titleBar: 'Запись на процедуру:' + procedureName,
                width: 360,
                zIndex: 0,
                offsetLeft: 0,
                offsetTop: 0,
                draggable: {restrict: false},
                buttons: [
                    new BX.PopupWindowButton({
                        text: 'Забронировать',
                        className: 'popup-window-button-send',
                        events: {
                            click: function() {
                                var box = this.popupWindow.getContentContainer();
                                var patient = box.querySelector('#booking-patient').value;
                                var date = dateInput.value;
                                BX.ajax.post(
                                    '/local/modules/custom.booking/lib/booking/addBooking.php',
                                    {
                                        patientName: patient,
                                        date: date,
                                        procedureId: procedureId,
                                        sessid: BX.bitrix_sessid()
                                    },
                                    function (response) {
                                        myPopup.close();
                                        alert(response);
                                    }
                                );
                            }
                        }
                    })
                ]
            }
        );

        myPopup.show();
        var dateInput = myPopup.popupContainer.querySelector('#booking-date');
        BX.bind(dateInput, 'click', function () {
            BX.calendar({node: dateInput, field: dateInput, bTime: true});
        });
}