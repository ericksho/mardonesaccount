var $collectionHolder;

// setup an "add a item" link
var $addItemLink = $('<a href="#" class="add_item_link btn btn-default"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></a>');
var $newLinkLi = $('<li style="display:inline-flex;"></li>').append($addItemLink);

jQuery(document).ready(function() {
    // Get the ul that holds the collection of items
    $collectionHolder = $('ol.items');

    // add a delete link to all of the existing tag form li elements
    $collectionHolder.find('li').each(function() {
        addTagFormDeleteLink($(this));
    });

    // add the "add a item" anchor and li to the items ul
    $collectionHolder.append($newLinkLi);

    // count the current form inputs we have (e.g. 2), use that as the new
    // index when inserting a new item (e.g. 2)
    $collectionHolder.data('index', $collectionHolder.find(':input').length);

    $addItemLink.on('click', function(e) {
        // prevent the link from creating a "#" on the URL
        e.preventDefault();

        // add a new item form (see next code block)
        addItemForm($collectionHolder, $newLinkLi);
    });

    $(".js-basic-single").select2({
        allowClear: false,
        width: '100%'
    });        

    if($collectionHolder.find(':input').length == 0)
    {
        $addItemLink.trigger('click');
        setTimeout(function() {}, 50);
        $('.head').css('width',parseInt($('#booksbundle_voucher_items_0_credit').parent().css('width'),10)+5);
    }
    else
    {
        styleForms();
        $('.head').css('width',parseInt($('[id^=booksbundle_voucher_items_]').parent().css('width'),10)+5);
    }

    $('.head').css('text-align', 'center');
    $('.head').parent().find('a').remove();

    checkRemoveButton();

    //////crear boton de presubmit y ocultar el de submit
    var texto = $('form[name=booksbundle_voucher]').find(':submit').val();
    $('form[name=booksbundle_voucher]').append('<input type="btn" onclick="checkItemsContent()" class="btn btn-success" value="'+texto+'"/>');
    $('form[name=booksbundle_voucher]').find(':submit').hide();
});

function addItemForm($collectionHolder, $newLinkLi) 
{
    // Get the data-prototype explained earlier
    var prototype = $collectionHolder.data('prototype');

    // get the new index
    var index = $collectionHolder.data('index');

    var newForm = prototype;
    // You need this only if you didn't set 'label' => false in your items field in VoucherType
    // Replace '__name__label__' in the prototype's HTML to
    // instead be a number based on how many items we have
    // newForm = newForm.replace(/__name__label__/g, index);

    // Replace '__name__' in the prototype's HTML to
    // instead be a number based on how many items we have
    newForm = newForm.replace(/__name__/g, index);

    // increase the index with one for the next item
    $collectionHolder.data('index', index + 1);

    // Display the form in the page in an li, before the "Add a item" link li
    var $newFormLi = $('<li></li>').append(newForm);
    $newLinkLi.before($newFormLi);

    // add a delete link to the new form
    addTagFormDeleteLink($newFormLi);

    styleForms();
    checkRemoveButton();
}

function addTagFormDeleteLink($tagFormLi) {
    var $removeFormA = $('<a href="#" class="btn btn-default remove-item"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>');
    $tagFormLi.append($removeFormA);

    $removeFormA.on('click', function(e) {
        // prevent the link from creating a "#" on the URL
        e.preventDefault();

        // remove the li for the tag form
        $tagFormLi.remove();

        checkRemoveButton();
    });
}

function checkRemoveButton()
{
    if($('.remove-item').length == 1)
    {
        $('.remove-item').hide();   
    }
    else
    {
        $('.remove-item').show();
    }
}

function checkItemsContent()
{
    $('.items li:not(:first):not(:last)').each( function (){
        remove = true;
        emptyCount = 0;
        $(this).find('input').each( function(){
            if($(this).val() == "")
            {
                emptyCount++;
            }
        });
        if(emptyCount == 3)
        {
            $(this).remove();
        }
    });

    $('form[name=booksbundle_voucher]').find(':submit').trigger('click');
}

function styleForms()
{
    $('li').css('padding-bottom','5px')
    $('[id^=booksbundle_voucher_items_]').parent().css('padding-right','5px');
}

















