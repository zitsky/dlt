export default {
    header: 'Digitalogica testwork',
    defaults: {
        create:'Create entry',
        close:'Close',
        cancel:'Cancel',
        update:'Update entry',
        select:'Apply',
        success_create:'Successfully created',
        success_update:'Successfully updated',
        success_delete:'Successfully deleted',
        actions:'Actions',
        destroy:'Delete',
        modal:{
            destroy:{
                title:'Destroy entry',
                content:'You really want delete entry?'
            }
        },
        errors:{
            alreadyuse:'Already used'
        }
    },
    users: {
        title:'Customers',
        add_user:'Add customer',
        table:{
            id:"#",
            first_name:"First name",
            last_name:"Last name",
            country:"Country",
            emails:"EMails",
            websites:"Websites"
        },
        form:{
            first_name:"First name",
            last_name:"Last name",
            country:"Country",
            email:"EMail",
            website:"Website",
            checkbox_def:"As default"
        },
        modal:{
            add_title:'Add customer',
            edit_title:'Edit customer'
        },
        errors:{
            email_notvalid:'Email already used',
            website_notvalid:'Website already used'
        },
        add_email:'Add E-Mail',
        add_website:'Add Website'
    },
    dashboard: {
        title:'Statistics',
        payments:'Pays',
        users:'Customer registrations',
        slice:{
            day:'by Day',
            week:'by Week',
            month: 'by Month'
        },
        payment_table:{
            key:'Date',
            val:'Cost'
        },
        customer_table: {
            key:'Date',
            val:'Count'
        }
    },
    payments: {
        title:'Payments',
        table: {
            id:"#",
            customer:"Customer",
            "date":"Date",
            "cost":"Cost"
        }
    },
    langs: {
        ru: 'Russian',
        en: 'English'
    }
};
