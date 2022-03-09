const onEachFeature = (f, l) => {
    var properties = f.properties;
    l.setStyle({
        fillColor: properties.color,
    });
};
