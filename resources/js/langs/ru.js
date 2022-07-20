
export default {
    header: 'Digitalogica Тестовое задание',
    defaults: {
        create:'Создать',
        close:'Закрыть',
        cancel:'Отменить',
        update:'Сохранить',
        select:'Применить',
        success_create:'Успешно создано',
        success_update:'Успешно обновлено',
        success_delete:'Успешно удалено',
        actions:'Действия',
        destroy:'Удалить',
        modal:{
            destroy:{
                title:'Удаление записи',
                content:'Вы действительно хотите удалить запись?'
            }
        },
        errors:{
            alreadyuse:'Уже используется'
        }
    },
    users: {
        title:'Клиенты',
        add_user:'Добавить клиента',
        table:{
            id:"#",
            first_name:"Имя",
            last_name:"Фамилия",
            country:"Страна",
            emails:"E-Mails",
            websites:"Веб-Сайты"
        },
        form:{
            first_name:"Имя",
            last_name:"Фамилия",
            country:"Страна",
            email:"E-Mail",
            website:"Веб-Сайт",
            checkbox_def:"По умолчанию"
        },
        modal:{
            add_title:'Добавить клиента',
            edit_title:'Редактирование клиента'
        },
        errors:{
            email_notvalid:'Email уже используется',
            website_notvalid:'Веб-сайт уже используется'
        },
        add_email:'Добавить EMail',
        add_website:'Добавить Веб-Сайт'
    },
    dashboard: {
        title:'Статистика',
        payments:'Платежи',
        users:'Клиенты',
        slice:{
            day:'По дням',
            week:'По неделям',
            month: 'По месяцам'
        },
        payment_table:{
            key:'Дата',
            val:'Сумма'
        },
        customer_table: {
            key:'Дата',
            val:'Кол-во'
        }
    },
    payments: {
        title:'Платежи',
        table: {
            id:"#",
            customer:"Клиент",
            "date":"Дата",
            "cost":"Цена"
        }
    },
    langs: {
        ru: 'Русский',
        en: 'Английский'
    }
};
